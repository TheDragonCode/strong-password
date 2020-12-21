<?php

namespace Helldar\StrongPassword\Support;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Validator;

final class Password
{
    public function validate(string $password = null): array
    {
        return $this->validator($password)->validated();
    }

    public function errors(string $password = null): ?array
    {
        $validator = $this->validator($password);

        return $validator->fails()
            ? $validator->errors()->toArray()
            : null;
    }

    public function isAllow(string $password = null): bool
    {
        return ! $this->errors($password);
    }

    protected function validator(string $password = null): ValidatorContract
    {
        return Validator::make(compact('password'), ['password' => $this->rules()]);
    }

    protected function rules(): array
    {
        return config('strong-password.rules', ['psw_strong']);
    }
}
