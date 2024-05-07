<?php

namespace App\CompanyService\Note\Domain\Services;

use App\CompanyService\Note\Domain\Repositories\ShowRepository as Repository;

class ShowService
{
    public function __construct(
        private Repository $repository
    ){}

    public function handle(string $id): array
    {
        return  $this->repository->get($id);
    }
}
