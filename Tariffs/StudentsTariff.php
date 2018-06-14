<?php

namespace Tariffs;

class StudentsTariff extends AbstractTariff
{
    const TARIF_NAME = 'Студенческий';
    const PRICE_PER_KM = 4;
    const PRICE_PER_MIN = 1;

    //ВОПРОС ПРАВИЛЬНО ЛИ Я ПЕРЕОПРЕДЕЛИЛ КОНСТАНТУ В ИНТЕРФЕЙСЕ?
    const MAX_AGE = 25;
    public function checkAge()
    {
        if ($this->getAge() < self::MIN_AGE || $this->getAge() > self::MAX_AGE) {
            throw new Exception('Указанный возраст не попадает в допустимый.');
        }
    }

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
