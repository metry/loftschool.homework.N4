<?php

namespace Tariffs\Logger;

abstract class AbstractLogger
{
    private $tariffName;
    private $drivePrice;

    public function setTariffName($tariffName)
    {
        $this->tariffName = $tariffName;
    }

    public function setDrivePrice($drivePrice)
    {
        $this->drivePrice = $drivePrice;
    }



    protected function getTariffName()
    {
        return $this->tariffName;
    }

    protected function getDrivePrice()
    {
        return $this->drivePrice;
    }

    public function isValid()
    {
        //ПРАВИЛЬНО ЛИ СДЕЛАЛ ПРОВЕРКУ? И НУЖНО ЛИ ПРОВЕРЯТЬ > 0
        if (!isset($this->tariffName)) {
            throw new Exception('Название тарифа не передано');
        }
        if (!isset($this->drivePrice)) {
            throw new Exception('Итоговая цена поездки не передана');
        }
    }

    abstract public function printLog();
}
