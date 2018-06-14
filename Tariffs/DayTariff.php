<?php

namespace Tariffs;

class DayTariff extends AbstractTariff
{
    const TARIF_NAME = 'Суточный';
    const PRICE_PER_KM = 1;
    const PRICE_PER_DAY= 1000;
    const HALF_AN_HOUR = 30;

    private function getDriveTimeInFullDays()
    {
        //округление до 24 часов в большую сторону, но не менее 30 минут. Например 24
        //часа 29 минут = 1 сутки. 23 часа 59 минут = 1 сутки. 24 часа 31 минута = 2 суток.
        if ($this->getDriveTimeMinutes() <= self::HALF_AN_HOUR) {
            return ceil($this->getDriveTimeMinutes() / self::MIN_IN_HOUR / self::HOUR_IN_DAY);
        }
        return ceil(($this->getDriveTimeMinutes() - self::HALF_AN_HOUR) / self::MIN_IN_HOUR / self::HOUR_IN_DAY);
    }

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
        return ($this->getDriveDistanceKm() * self::PRICE_PER_KM + $this->getDriveTimeInFullDays()
                * self::PRICE_PER_DAY) * $this->getAgePercent() + $gpsTraitPrice + $SecondDriverPrice;
    }
}
