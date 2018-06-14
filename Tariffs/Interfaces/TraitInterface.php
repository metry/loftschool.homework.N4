<?php

namespace  Tariffs\Interfaces;

interface TraitInterface
{
    const NAME_GPS_TRAIT = 'gps';
    const NAME_SECOND_DRIVER_TRAIT = 'second driver';
    const GPS_PRICE_PER_HOUR = 15;
    const SECOND_DRIVER_PRICE = 100;

    public function checkTraitsNames();
}
