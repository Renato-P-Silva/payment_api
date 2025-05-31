<?php

namespace App\Infra\Request\Validation;

use App\Infra\Request\Validation\Exceptions\InvalidArrayDataException;
use App\Infra\Request\Validation\Exceptions\InvalidRequestDataException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ValidatorReal
{
    public function validateRequest(Request $request, array $rules): void
    {
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            throw new InvalidRequestDataException($this->formatErrors($validate->errors()));
        }
    }

    public function validateArrayData(array $array, array $rules): void
    {
        $validate = Validator::make($array, $rules);
        if ($validate->fails()) {
            throw new InvalidArrayDataException($this->formatErrors($validate->errors()));
        }
    }

    protected function formatErrors(MessageBag $errors): string
    {
        $translatedErrors = [];
        foreach ($errors->toArray() as $field => $messages) {
            $translatedKey = ucfirst(str_replace('_', ' ', $field));
            $translatedErrors[$translatedKey] = $messages;
        }

        return json_encode($translatedErrors, JSON_UNESCAPED_UNICODE);
    }
}
