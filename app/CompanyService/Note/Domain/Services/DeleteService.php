<?php

namespace App\CompanyService\Note\Domain\Services;

use App\CompanyService\Note\Domain\Models\Notes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeleteService
{
    public function handle(string $id): bool
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

            $this->delete($note);

            DB::commit();

            Log::channel('user_note')->info('Success deleted note', [
                'note_id' => $note->id,
                'user_id' => auth()->id(),
                'action' => 'Deleted noted',
                'level' => 'info'
            ]);

            return true;

        } catch (\Exception $e) {
            DB::rollBack();

            Log::channel('user_note')->error('User couldnt deleted  note', [
                'note_id' => $note->id,
                'author_note_id' => $note->user_id,
                'user_id' => auth()->id(),
                'action' => 'Error note',
                'level' => 'error'
            ]);

            return false;
        }
    }
    private function delete($note):bool
    {
        $note->delete();

        return true;
    }
}
