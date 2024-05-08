<?php

namespace App\CompanyService\Note\Domain\Services;

use App\CompanyService\Note\Domain\Models\Notes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddService
{
    public function handle(array $data=[]): bool
    {
        DB::beginTransaction();

        try {
            $notes = Notes::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'status' => $data['status'],
                'user_id' => auth()->id(),
            ]);

            Log::channel('user_note')->info('User created new note', [
                'user_id' => auth()->id(),
                'note_id' => $notes['id'],
                'action' => 'Create note',
                'level' => 'info'
            ]);

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();

            Log::channel('user_note')->error('User couldnt add new note', [
                'user_id' => auth()->id(),
                'action' => 'Error note',
                'level' => 'error'
            ]);

            return false;
        }
    }
}
