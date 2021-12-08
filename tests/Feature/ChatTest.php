<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Str;
use App\Events\RealTimeMessage;
use App\Http\Livewire\User\Messages;
use Illuminate\Support\Facades\Event;

class ChatTest extends TestCase
{

    public function test_a_none_collaborator_user_cannot_access_messages()
    {
        $user = User::factory()->create(['role' => 2]);
        $this->actingAs($user);
        Livewire::test(Messages::class)
            ->assertRedirect(route('search'));
    }

    public function test_admin_cannot_access_messages_when_not_authenticated()
    {
        $this->get(route('admin.messages'))
            ->assertRedirect(route('admin.login', ['lang' => app()->getLocale()]));
    }

    public function test_admin_and_collabs_cannot_broadcast_a_message_when_invalid()
    {
        $user = User::factory()->create(['role' => 2]);
        $this->actingAs($user);
        Livewire::test(Messages::class)
            ->set('body', null)
            ->set('members', User::whereIn('role', [0, 1])->get())
            ->call('saveMessage')
            ->assertHasErrors('body');
    }

    public function test_admin_and_collabs_can_broadcast_a_message_when_valid()
    {
        Event::fake();
        $user = User::factory()->create(['role' => 1]);
        $this->actingAs($user);
        Livewire::test(Messages::class)
            ->set('body', Str::random(10))
            ->call('saveMessage')
            ->assertHasNoErrors('body')
            ->assertSet('body', null);
        Event::assertDispatched(RealTimeMessage::class);
    }


    public function test_collabs_and_admin_see_typing_indicator_when_someone_is_typing()
    {
        $user = User::factory()->create(['role' => 1]);
        $this->actingAs($user);
        Livewire::test(Messages::class)
            ->assertSet('typing', false)
            ->call('typing', $user->name)
            ->assertSet('typing', true)
            ->assertEmitted('typing-remove');
    }
}
