<?php

namespace Helldar\StrongPassword\Support;

use Illuminate\Support\Facades\App;
use NumberToWords\NumberToWords;
use NumberToWords\NumberTransformer\NumberTransformer;

class Number
{
    public function toWords(int $value): string
    {
        return $this->transformer()->toWords($value);
    }

    protected function transformer(): NumberTransformer
    {
        return $this->service()->getNumberTransformer(
            $this->locale()
        );
    }

    protected function service()
    {
        return new NumberToWords();
    }

    protected function locale(): string
    {
        return App::getLocale();
    }
}
