<?php

namespace App\Infra\UseCase\Read;

interface IListUseCase
{
    public function execute(int $perPage, int $page, array|null $queryParams = null): array;
}
