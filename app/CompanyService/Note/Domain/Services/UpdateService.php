<?php

namespace App\CompanyService\Note\Domain\Services;

use App\CompanyService\Note\Domain\Models\Notes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateService
{
    public function handle(string $id , array $data=[]): bool
    {
        try {
            DB::beginTransaction();

            $note = Notes::find($id);

            if (empty($note)) {
                throw new \Exception("Note not found");
            }

            if ($note->user_id !== auth()->id()) {
                throw new \Exception("Unauthorized access");
            }

            $this->update($note, $data);

            DB::commit();

            Log::channel('user_note')->info('Success change note', [
                'note_id' => $note->id,
                'user_id' => auth()->id(),
                'action' => 'Change noted',
                'level' => 'info'
            ]);

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            Log::channel('user_note')->error('User couldnt change  note', [
                'note_id' => $note->id ?? intval(isset($note->id) ? $note->id : null),
                'author_note_id' => $note->user_id ?? null,
                'user_id' => auth()->id(),
                'action' => 'Error note',
                'level' => 'error'
            ]);

            return false;
        }
    }

    private function update($note, $data):bool
    {
        $note->update($data);

        return true;
    }
}
