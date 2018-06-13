<?php

namespace Tariffs;

class HoursTariff extends AbstractTariff
{
    protected $name = 'Почасовой';
    protected $pricePerKm = 0;
    protected $pricePerMin = 200/60;

    public function getPrice()
    {
        //если обращаться напрямую к методу, чтобы исключить ошибку
        if (!$this->checkAge($this->age)) {
            return null;
        }
        $this->driveTimeMinutesFixed = $this->driveTimeHours * 60;
        $this->printReport();
    }
}
