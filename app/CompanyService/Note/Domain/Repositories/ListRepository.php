<?php

namespace App\CompanyService\Note\Domain\Repositories;

use App\Models\Note;

class ListRepository
{
    public function getList(array $data): array
    {
        $note =  Note::query()
            ->select(
                'id',
                'title',
                'content',
                'status',
                'created_at',
                'updated_at'
            )
            ->where('user_id', auth()->id());

        if (!empty($data)) {
            match ($data['sort']) {
                'title' => $note->orderBy('title', 'asc'),
                'content' => $note->orderBy('content', 'asc'),
                'status' => $note->orderBy('status', 'asc'),
                'updated_at' => $note->orderBy('updated_at', 'desc'),
                default => $note->orderBy('created_at', 'desc')
            };

            return $note->paginate(20)->toArray();
        }

        return $note
            ->orderBy('id', 'asc')
            ->paginate(20)
            ->toArray();
    }
}
