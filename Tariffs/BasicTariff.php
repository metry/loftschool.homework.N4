<?php

namespace Tariffs;

class BasicTariff extends AbstractTariff
{
    const TARIF_NAME = 'Базовый';
    const PRICE_PER_KM = 10;
    const PRICE_PER_MIN = 3;

    public function getDrivePrice()
    {
        $gpsTraitPrice = self::ZERO_PRICE;
        foreach ($this->getTraits() as $trait) {
            if ($trait == self::NAME_GPS_TRAIT) {
                $gpsTraitPrice =
                    Traits\GpsTrait::getGpsTraitPrice($this->getDriveTimeInFullHours(), self::GPS_PRICE_PER_HOUR);
            }
        }
        return ($this->getDriveDistanceKm() * self::PRICE_PER_KM + $this->getDriveTimeMinutes() * self::PRICE_PER_MIN)
            * $this->getAgePercent() + $gpsTraitPrice;
    }
}
