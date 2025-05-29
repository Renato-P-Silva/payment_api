<?php

namespace App\Modules\User\Controller;

use App\Infra\Controller\Read\BaseListController;
use App\Infra\UseCase\Read\IListUseCase;
use App\Models\User\User;
use App\Modules\User\UseCase\UserListUseCase;

class UserListController extends BaseListController
{
    public function __construct(protected UserListUseCase $useCase)
    {
    }

    protected function getUseCase(): IListUseCase
    {
        return $this->useCase;
    }

    protected function getModelName(): string
    {
        return User::class;
    }
}
