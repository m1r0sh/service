<?php

namespace App\CompanyService\Note\Domain\Repositories;

use App\Models\Note;

class ShowRepository
{
    public function get(string $id): array
    {
        $note =  Note::query()
            ->select(
                'id',
                'title',
                'content',
                'status',
                'user_id',
                'created_at',
                'updated_at'
            )
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->get()
            ->toArray();

        return $note;
    }
}
