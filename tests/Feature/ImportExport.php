<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Http\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Admin\UserManagement;

class ImportExportTest extends TestCase
{
    public function admin_can_import_users_or_words()
    {
        Excel::fake();

        $exampleFile = new File(storage_path('app/imports/users.xlsx'));

        dd($exampleFile); // TODO: aaml file users.xlsx 7otha ala jnab bsh tab9a dima testi feha
        $this->actingAs(User::where('email', 'derja@admin')->first());

        Livewire::test(UserManagement::class)
            ->set('document', $exampleFile)
            ->call('updatedDocument');

        Excel::assertImported('users.xlsx', 'imports');
    }

    public function user_can_download_invoices_export()
    {
        Storage::disk('imports')->assertExists('users.xlsx'); // sinn khali hedha wakhw wala bagges alehom
    }
}
