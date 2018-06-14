<?php

namespace Tariffs\Traits;

trait GpsTrait
{
    public static function getGpsTraitPrice($hours, $GpsPricePerHour)
    {
        return $hours * $GpsPricePerHour;
    }
}
