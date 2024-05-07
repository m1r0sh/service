<?php

namespace App\CompanyService\Note\Domain\Services;

use App\CompanyService\Note\Domain\Repositories\ListRepository as Repository;

class ListService
{
    public function __construct(
        private Repository $repository
    ){}

    public function handle(array $data=[]): array
    {
        return  $this->repository->getList($data);
    }
}
