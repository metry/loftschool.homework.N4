<?php

namespace Tariffs;

trait GpsTrait
{
    protected $gpsPricePerHour = 15;

    protected function addGpsValue($hours)
    {
        return $hours * $this->gpsPricePerHour;
    }

    protected function addGpsReport($hours)
    {
        return " + " . $hours . " * " . $this->gpsPricePerHour . " ";
    }
}
