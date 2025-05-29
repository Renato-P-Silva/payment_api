<?php

namespace App\Infra\UseCase\Read;

/**
 * @deprecated - Usar a IListUseCaseV2
 * @see IListUseCaseV2
 */
interface IListUseCase
{
    public function execute(int $perPage, int $page, array|null $queryParams = null): array;
}
