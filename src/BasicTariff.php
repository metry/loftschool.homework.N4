<?php

namespace Tariffs;

class BasicTariff extends AbstractTariff
{
    protected $name = 'Базовый';
    protected $pricePerKm = 10;
    protected $pricePerMin = 3;
    protected $secondDriverTraitAvailable = false;
}
