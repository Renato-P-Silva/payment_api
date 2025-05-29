<?php

namespace App\Modules\User\UseCase;

use App\Infra\UseCase\Read\IListUseCase;
use App\Models\User\User;

class UserListUseCase implements IListUseCase
{
    public function execute(int $perPage, int $page, ?array $queryParams = null): array
    {
        return User::query()->paginate($perPage, ['*'], 'page', $page)->toArray();
    }
}
