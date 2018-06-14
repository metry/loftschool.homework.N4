<?php

namespace  Tariffs\Interfaces;

interface TariffsInterface
{
    const MIN_IN_HOUR = 60;
    const HOUR_IN_DAY = 24;
    const ZERO_PRICE = 0;

    public function setAge($age);

    public function setDriveDistanceKm($driveDistanceKm);

    public function setDriveTimeMinutes($driveTimeMinutes);

    public function setTraits($traits);

    public function isValid();

    public function getDrivePrice();
}
