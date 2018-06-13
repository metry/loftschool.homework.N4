<?php

namespace Tariffs;

abstract class AbstractTariff implements TariffsInterface
{
    const MIN_AGE = 18;
    const SAFE_AGE = 21;
    const YOUNG_PERCENT = 1.1;
    protected $maxAge = 65; //будет меняться в тарифе для студентов
    //значения которые прихрдят в массив trait в конструктор
    const NAME_GPS_TRAIT = 'gps';
    const NAME_SECOND_DRIVER_TRAIT = 'second driver';
    //доступность трейтов для классов
    protected $gpsTraitAvailable = true; //так как доступно для всех тарифов
    protected $secondDriverTraitAvailable = true; //доступно для всех тарифов, кроме базового и студенческого

    protected $pricePerKm;
    protected $pricePerMin;
    protected $name;

    protected $driveDistanceKm;
    protected $driveTimeMinutes;
    protected $age;
    protected $agePercent;
    protected $driveTimeHours;
    protected $driveTimeMinutesFixed;

    use GpsTrait;
    use SecondDriverTrait;

    public function __construct(float $driveDistanceKm, float $driveTimeMinutes, int $age, array $traits = [])
    {
        //в конструкторе проверяю возраст
        if (!$this->checkAge($age)) {
            return null;
        }
        //вводимые данные заношу в свойства класса
        $this->driveDistanceKm = $driveDistanceKm;
        $this->driveTimeMinutes = $driveTimeMinutes;
        $this->age = $age;
        $this->traits = $traits;
        //рассчитываю дополнительные свойства
        $this->agePercent = $this->getAgePercent($this->age);
        $this->driveTimeHours = $this->getTimeHours(); //для трейта
        //вызываю из конструктора основной метод
        //если убрать след. строку, то в index.php после создания экз. класса нужно вызывать этот метод.
        $this->getPrice();
    }

    protected function checkAge(int $age)
    {
        if ($age < self::MIN_AGE || $age > $this->maxAge) {
            echo '<hr>Простите, но вы не подходите по возрасту<hr>';
            return null;
        }
        return true;
    }

    protected function getAgePercent(int $age)
    {
        if ($age > self::SAFE_AGE) {
            return 1;
        } else {
            return self::YOUNG_PERCENT;
        }
    }

    protected function getTimeHours()
    {
        return ceil($this->driveTimeMinutes / 60);
    }

    public function getPrice()
    {
        //если обращаться напрямую к методу, чтобы исключить ошибку
        if (!$this->checkAge($this->age)) {
            return null;
        }
        $this->driveTimeMinutesFixed = $this->driveTimeMinutes;
        $this->printReport();
    }

    protected function printReport()
    {
        //обработка трейтов
        foreach ($this->traits as $trait) {
            if ($trait == self::NAME_GPS_TRAIT && $this->gpsTraitAvailable) {
                $gpsValue = self::addGpsValue($this->driveTimeHours);
                $gpsReport = self::addGpsReport($this->driveTimeHours);
            } elseif ($trait == self::NAME_SECOND_DRIVER_TRAIT && $this->secondDriverTraitAvailable) {
                $secondDriverValue = self::addSecondDriverValue();
                $secondDriverReport = self::addSecondDriverReport();
            } else {
                $error = 'Услуга "' . $trait . '" не доступна в данном тарифе<br>';
            }
        }

        $value = ($this->driveDistanceKm * $this->pricePerKm + $this->driveTimeMinutesFixed * $this->pricePerMin)
            * $this->agePercent + $gpsValue + $secondDriverValue;

        $msg = "<hr>";
        $msg .= "Исходные данные: $this->driveDistanceKm км, $this->driveTimeMinutes мин, полных лет $this->age<br>";
        $msg .= "Дополнительные услуги: " . implode('; ', $this->traits) . "<br>";
        $msg .= $error;
        $msg .= "Рассчет: ";
        $msg .= "$this->name ($this->driveDistanceKm км, $this->driveTimeMinutesFixed мин, полных лет $this->age)";
        $msg .= " = ($this->driveDistanceKm * $this->pricePerKm + $this->driveTimeMinutesFixed * $this->pricePerMin)";
        $msg .= " * $this->agePercent" . $gpsReport . $secondDriverReport . "= $value руб.<br>";
        $msg .= "<hr>";
        echo $msg;

        return null;
    }
}
