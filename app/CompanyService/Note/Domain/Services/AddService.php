<?php

namespace App\CompanyService\Note\Domain\Services;

use App\CompanyService\Note\Domain\Models\Notes;
use Illuminate\Support\Facades\DB;

class AddService
{
    public function handle(array $data=[]): bool
    {
        DB::beginTransaction();

        try {
            Notes::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'status' => $data['status'],
                'user_id' => auth()->id(),
            ]);

            //LOG HERE

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
