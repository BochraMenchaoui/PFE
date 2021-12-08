<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Word;
use Livewire\Livewire;
use Illuminate\Support\Str;
use App\Http\Livewire\Dict\Detail;
use Illuminate\Support\Facades\Cache;
use App\Notifications\RealTimeNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WordLikedCommentedNotification;

class UserInteractionTest extends TestCase
{
    public function test_user_cannot_see_word_details_when_not_authenticated()
    {
        $word = Word::factory()->create();

        $this->get(route('details', ['id' => $word->id]))
            ->assertRedirect(route('login'));
    }

    public function test_user_cannot_see_word_when_authenticated_but_word_is_unpublished()
    {
        $word = Word::factory()->create();
        $user = User::factory()->create([
            'role' => 2
        ]);

        $this->actingAs($user);

        Livewire::test(Detail::class, ['id' => $word->id])
            ->assertRedirect(route('search'));
    }

    public function test_user_can_see_word_details_when_authenticated_and_word_is_published()
    {
        $word = Word::factory()->create(['published' => 1]);
        $user = User::factory()->create(['role' => 2]);

        $this->actingAs($user)
            ->get(route('details', ['id' => $word->id]))
            ->assertSeeLivewire('dict.detail');
    }

    public function test_user_can_like_a_word()
    {
        $word  = Word::factory()->create(['published' => 1]);
        $user  = User::factory()->create(['role' => 2]);
        $owner = $word->user;

        $users[] = [
            'id'               => $user->id,
            'role'             => $user->role,
            'last_activity_at' => now()
        ];

        Cache::put('online-users', $users);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'word_id' => $word->id,
        ]);

        $this->actingAs($user);

        Livewire::test(Detail::class, ['id' => $word->id])
            ->call('like');

        Notification::assertSentTo($owner, WordLikedCommentedNotification::class);
        Notification::assertSentTo($user, RealTimeNotification::class);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'word_id' => $word->id,
        ]);

        $this->assertDatabaseMissing('dislikes', [
            'user_id' => $user->id,
            'word_id' => $word->id,
        ]);
    }

    public function test_user_cannot_like_a_word_when_he_already_liked()
    {
        $word  = Word::factory()->create(['published' => 1]);
        $user  = User::factory()->create(['role' => 2]);
        $owner = $word->user;

        $user->likes()->attach($word->id);

        $this->actingAs($user);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'word_id' => $word->id,
        ]);

        Livewire::test(Detail::class, ['id' => $word->id])
            ->call('like');

        Notification::assertNotSentTo($owner, WordLikedCommentedNotification::class);
    }

    public function test_user_can_dilike_a_word()
    {
        $word  = Word::factory()->create(['published' => 1]);
        $user  = User::factory()->create(['role' => 2]);

        $users[] = [
            'id'               => $user->id,
            'role'             => $user->role,
            'last_activity_at' => now()
        ];

        Cache::put('online-users', $users);

        $this->assertDatabaseMissing('dislikes', [
            'user_id' => $user->id,
            'word_id' => $word->id,
        ]);

        $this->actingAs($user);

        Livewire::test(Detail::class, ['id' => $word->id])
            ->call('dislike');

        Notification::assertSentTo($user, RealTimeNotification::class);

        $this->assertDatabaseHas('dislikes', [
            'user_id' => $user->id,
            'word_id' => $word->id,
        ]);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'word_id' => $word->id,
        ]);
    }

    public function test_user_cannot_dislike_a_word_when_he_already_disliked()
    {
        $word  = Word::factory()->create(['published' => 1]);
        $user  = User::factory()->create(['role' => 2]);

        $user->dislikes()->attach($word->id);

        $this->actingAs($user);

        $this->assertDatabaseHas('dislikes', [
            'user_id' => $user->id,
            'word_id' => $word->id,
        ]);

        Livewire::test(Detail::class, ['id' => $word->id])
            ->call('like');

        Notification::assertNotSentTo($user, RealTimeNotification::class);
    }

    public function test_user_cannot_comment_when_empty_input()
    {
        $word  = Word::factory()->create(['published' => 1]);
        $user  = User::factory()->create(['role' => 2]);

        $this->actingAs($user);
        Livewire::test(Detail::class, ['id' => $word->id])
            ->set('body', null)
            ->call('comment')
            ->assertHasErrors(['body' => 'required']);
    }

    public function test_user_cannot_comment_when_invalid_input()
    {
        $word  = Word::factory()->create(['published' => 1]);
        $user  = User::factory()->create(['role' => 2]);

        $this->actingAs($user);
        Livewire::test(Detail::class, ['id' => $word->id])
            ->set('body', Str::random(5))
            ->call('comment')
            ->assertHasErrors(['body' => 'min']);
    }

    public function test_user_can_comment()
    {
        $word  = Word::factory()->create(['published' => 1]);
        $user  = User::factory()->create(['role' => 2]);
        $owner = $word->user;

        $this->actingAs($user);
        Livewire::test(Detail::class, ['id' => $word->id])
            ->set('body', $body = Str::random(10))
            ->call('comment')
            ->assertHasNoErrors('body')
            ->assertSet('body', null)
            ->assertSet('remainings', 1000);

        Notification::assertSentTo($owner, WordLikedCommentedNotification::class);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'word_id' => $word->id,
            'body'    => $body,
        ]);
    }
}
