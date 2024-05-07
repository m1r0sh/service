<?php

namespace App\CompanyService\Note\Domain\Services;

use App\CompanyService\Note\Domain\Models\Notes;

class DeleteService
{
    public function handle(string $id): bool
    {
        $note = Notes::find($id);

        return match (true) {
            empty($note) => false,
            $note->user_id !== auth()->id() => false,
            default => $this->delete($note),
        };
    }
    private function delete($note):bool
    {
        $note->delete();

        return true;
    }
}
