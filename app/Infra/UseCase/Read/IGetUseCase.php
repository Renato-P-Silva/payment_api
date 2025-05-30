<?php

namespace App\Infra\UseCase\Read;

interface IGetUseCase
{
    public function execute(int|string $id): array;
}
