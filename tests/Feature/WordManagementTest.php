<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Word;
use Livewire\Livewire;
use Illuminate\Support\Str;
use App\Http\Livewire\Admin\EditWord;
use App\Http\Livewire\Admin\CreateWord;
use App\Http\Livewire\Admin\WordManagement;
use App\Notifications\SubmittedWordProgressNotification;
use Illuminate\Support\Facades\Notification;

class WordManagementTest extends TestCase
{
    public function actingAsAdmin()
    {
        return $this
            ->actingAs(User::where('email', 'derja@admin')->first());
    }

    public function test_user_cannot_see_or_perform_any_action_to_words()
    {
        $this
            ->actingAs(User::find(random_int(2, 15)))
            ->from(route('profile'))
            ->get(route('admin.words'))
            ->assertRedirect(route('profile'));
    }

    public function test_admin_cannnot_perfom_any_action_to_users_when_not_authenticated()
    {
        $this
            ->get(route('admin.words'))
            ->assertRedirect(route('admin.login', ['lang' => app()->getLocale()]));
    }

    public function test_admin_can_create_words_when_authenticated()
    {
        $this->actingAsAdmin();

        Livewire::test(CreateWord::class)
            ->set('derja', 'derja')
            ->set('latin', 'latin')
            ->set('arabic', 'arabic')
            ->set('french', 'french')
            ->set('english', 'english')
            ->set('description', Str::random(100))
            ->set('origin', 'origin')
            ->set('region', 'region')
            ->call('store')
            ->assertSet('word_ar', null)
            ->assertDispatchedBrowserEvent('word-created', [
                'title' => 'Word created successfully.',
                'icon'  => 'success',
            ]);

        $this->assertDatabaseHas('words', [
            'word_ar' => 'derja',
            'word_lt' => 'latin',
            'user_id' => 1,
        ]);
    }

    public function test_admin_can_read_all_words_when_authenticated()
    {
        $this->actingAsAdmin()
            ->get(route('admin.words'))
            ->assertSuccessful()
            ->assertSeeLivewire('admin.word-management');
    }

    public function test_admin_can_update_words_when_authenticated()
    {
        $word = Word::factory()->create([
            'word_ar' => 'derja',
            'word_lt' => 'latin',
        ]);

        $this->actingAsAdmin();
        $this->assertDatabaseHas('words', [
            'word_ar' => $word->word_ar,
            'word_lt' => $word->word_lt,
        ]);
        Livewire::test(EditWord::class, ['id' => $word->id])
            ->set('derja', 'NewWordDerja')
            ->set('latin', 'NewWordLatin')
            ->call('store')
            ->assertHasNoErrors(['derja', 'latin'])
            ->assertDispatchedBrowserEvent('word-created', [
                'title' => 'Word updated successfully.',
                'icon'  => 'success',
            ]);

        $this->assertDatabaseMissing('words', [
            'word_ar' => $word->word_ar,
            'word_lt' => $word->word_lt,
        ]);

        $this->assertDatabaseHas('words', [
            'word_ar' => 'NewWordDerja',
            'word_lt' => 'NewWordLatin',
        ]);
    }

    public function test_admin_can_delete_words_when_authenticated()
    {
        $word = Word::factory()->create([
            'word_ar' => 'uniqueArabic',
        ]);

        $this->actingAsAdmin();

        $this->assertDatabaseHas('words', [
            'word_ar' => 'uniqueArabic',
        ]);

        Livewire::test(WordManagement::class)
            ->set('targetWord', $word->id)
            ->call('delete');

        Notification::assertSentTo($word->user, SubmittedWordProgressNotification::class);

        $this->assertDatabaseMissing('words', [
            'word_ar' => 'uniqueArabic',
        ]);
    }
}
