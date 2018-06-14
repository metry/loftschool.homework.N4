<?php

namespace Tariffs;

abstract class AbstractTariff implements Interfaces\TariffsInterface, Interfaces\AgeInterface, Interfaces\TraitInterface
{
    use Traits\GpsTrait;
    use Traits\SecondDriverTrait;

    private $age;
    private $driveDistanceKm;
    private $driveTimeMinutes;
    private $traits = [];

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function setDriveDistanceKm($driveDistanceKm)
    {
        $this->driveDistanceKm = $driveDistanceKm;
    }

    public function setDriveTimeMinutes($driveTimeMinutes)
    {
        $this->driveTimeMinutes = $driveTimeMinutes;
    }

    public function setTraits($traits = [])
    {
        $this->traits = $traits;
    }

    protected function getAge()
    {
        return $this->age;
    }

    protected function getDriveDistanceKm()
    {
        return $this->driveDistanceKm;
    }

    protected function getDriveTimeMinutes()
    {
        return $this->driveTimeMinutes;
    }

    protected function getTraits()
    {
        return $this->traits;
    }

    public function isValid()
    {
        //ПРАВИЛЬНО ЛИ СДЕЛАЛ ПРОВЕРКУ? И НУЖНО ЛИ ПРОВЕРЯТЬ > 0
        if (!isset($this->age)) {
            throw new Exception('Возраст не указан.');
        }
        if (!isset($this->driveDistanceKm)) {
            throw new Exception('Длинна маршрута не указана.');
        }
        if (!isset($this->driveTimeMinutes)) {
            throw new Exception('Время поездки в минутах не указано.');
        }
    }

    public function checkAge()
    {
        if ($this->age < self::MIN_AGE || $this->age > self::MAX_AGE) {
            throw new Exception('Указанный возраст не попадает в допустимый.');
        }
    }

    protected function getAgePercent()
    {
        return ($this->age > self::SAFE_AGE) ? self::HUNDRED_PERCENT : self::YOUNG_PERCENT;
    }

    protected function getDriveTimeInFullHours()
    {
        return ceil($this->driveTimeMinutes / self::MIN_IN_HOUR);
    }

    public function checkTraitsNames()
    {
        foreach ($this->traits as $trait) {
            switch ($trait) {
                case self::NAME_GPS_TRAIT:
                case self::NAME_SECOND_DRIVER_TRAIT:
                    break;
                default:
                    throw new Exception('Услуга ' . $trait . ' не существует');
            }
        }
    }

    abstract public function getDrivePrice();
}
