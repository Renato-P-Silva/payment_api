<?php

namespace App\Infra\Controller\Read;

use App\Infra\Controller\Controller;
use App\Infra\Response\Api\ResponseApi;
use App\Infra\Request\Enum\RequestQueryParamsEnum;
use App\Infra\UseCase\Read\IListUseCase;
use Illuminate\Http\JsonResponse;

abstract class BaseListController extends Controller
{
    private const int DEFAULT_PAGE = 1;
    private const int DEFAULT_PER_PAGE = 100;

    abstract protected function getUseCase(): IListUseCase;
    abstract protected function getModelName(): string;

    public function __invoke(): JsonResponse
    {
        $list = $this->getUseCase()->execute($this->getPerPage(), $this->getPage(), $this->getQueryParams());
        return ResponseApi::renderOkList($list);
    }

    protected function getPerPage()
    {
        return request()->get(RequestQueryParamsEnum::PerPage->value, self::DEFAULT_PER_PAGE);
    }

    public function getPage()
    {
        return request()->get(RequestQueryParamsEnum::Page->value, self::DEFAULT_PAGE);
    }

    public function getQueryParams(): array
    {
        return request()->query();
    }
}
