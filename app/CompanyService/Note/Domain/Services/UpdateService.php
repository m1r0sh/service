<?php

namespace App\CompanyService\Note\Domain\Services;

use App\CompanyService\Note\Domain\Models\Notes;

class UpdateService
{
    public function handle(string $id , array $data=[]): bool
    {
        $note = Notes::find($id);

        return match (true) {
            empty($note) => false,
            $note->user_id !== auth()->id() => false,
            default => $this->update($note, $data),
        };
    }

    private function update($note, $data):bool
    {
        $note->update($data);

        return true;
    }
}
