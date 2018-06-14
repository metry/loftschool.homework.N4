<?php

namespace Tariffs;

class HoursTariff extends AbstractTariff
{
    const TARIF_NAME = 'Почасовой';
    const PRICE_PER_KM = 0; //не нужно, мб буду использовать в логгере
    const PRICE_PER_HOUR= 200;

    public function getDrivePrice()
    {
        $gpsTraitPrice = self::ZERO_PRICE;
        $SecondDriverPrice = self::ZERO_PRICE;
        foreach ($this->getTraits() as $trait) {
            if ($trait == self::NAME_GPS_TRAIT) {
                $gpsTraitPrice =
                    Traits\GpsTrait::getGpsTraitPrice($this->getDriveTimeInFullHours(), self::GPS_PRICE_PER_HOUR);
            }
            if ($trait == self::NAME_SECOND_DRIVER_TRAIT) {
                $SecondDriverPrice = Traits\SecondDriverTrait::getSecondDriverTraitPrice(self::SECOND_DRIVER_PRICE);
            }
        }
        return ($this->getDriveTimeInFullHours() * self::PRICE_PER_HOUR)
            * $this->getAgePercent() + $gpsTraitPrice + $SecondDriverPrice;
    }
}
