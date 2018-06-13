<?php

namespace Tariffs;

class DayTariff extends AbstractTariff
{
    protected $name = 'Суточный';
    protected $pricePerKm = 1;
    protected $pricePerMin = 1000/24/60;

    public function getPrice()
    {
        //если обращаться напрямую к методу, чтобы исключить ошибку
        if (!$this->checkAge($this->age)) {
            return null;
        }
        //округление до 24 часов в большую сторону, но не менее 30 минут. Например 24
        //часа 29 минут = 1 сутки. 23 часа 59 минут = 1 сутки. 24 часа 31 минута = 2 суток.
        $this->driveTimeMinutesFixed = ceil(($this->driveTimeMinutes - 30) / 60 / 24) * 60 * 24;
        $this->printReport();
    }
}
