<?php

namespace Tariffs;

trait SecondDriverTrait
{
    protected $secondDriverPrice = 100;

    protected function addSecondDriverValue()
    {
        return $this->secondDriverPrice;
    }

    protected function addSecondDriverReport()
    {
        return " + " . $this->secondDriverPrice . " ";
    }
}
