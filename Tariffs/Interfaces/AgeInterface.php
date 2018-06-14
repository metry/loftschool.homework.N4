<?php

namespace  Tariffs\Interfaces;

interface AgeInterface
{
    const MIN_AGE = 18;
    const SAFE_AGE = 21;
    const MAX_AGE = 65;
    const YOUNG_PERCENT = 1.1;
    const HUNDRED_PERCENT = 1;

    public function checkAge();
}
