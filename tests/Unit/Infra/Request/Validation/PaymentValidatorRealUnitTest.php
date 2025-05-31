<?php

namespace Tests\Unit\Infra\Request\Validation;

use App\Infra\Request\Validation\Exceptions\InvalidArrayDataException;
use App\Infra\Request\Validation\Exceptions\InvalidRequestDataException;
use App\Infra\Request\Validation\ValidatorReal;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\PaymentUnitTest;

class PaymentValidatorRealUnitTest extends PaymentUnitTest
{
    #[TestDox("Testando com dados inválidos")]
    public function testValidateRequestTestOne()
    {
        $this->expectException(InvalidRequestDataException::class);
        $this->expectExceptionMessage('{"Name":["The name field is required."]}');

        $request = new Request();
        $request->merge(['name' => '']);
        $horusValidator = new ValidatorReal();
        $horusValidator->validateRequest($request, ['name' => 'required']);
    }

    #[TestDox("Testando com dados válidos")]
    public function testValidateRequestTestTwo()
    {
        $request = new Request();
        $request->merge(['name' => 'Teste']);

        $horusValidator = new ValidatorReal();
        $horusValidator->validateRequest($request, ['name' => 'required']);
        $this->assertTrue(true);
    }

    #[TestDox("Testando com dados inválidos")]
    public function testValidateArrayDataTestOne()
    {
        $this->expectException(InvalidArrayDataException::class);
        $this->expectExceptionMessage('{"Name":["The name field is required."]}');

        $array = ['name' => ''];
        $horusValidator = new ValidatorReal();
        $horusValidator->validateArrayData($array, ['name' => 'required']);
    }

    #[TestDox("Testando com dados válidos")]
    public function testValidateArrayDataTestTwo()
    {
        $array = ['name' => 'Teste'];

        $horusValidator = new ValidatorReal();
        $horusValidator->validateArrayData($array, ['name' => 'required']);

        $this->assertTrue(true);
    }
}
