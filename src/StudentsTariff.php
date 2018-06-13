<?php

namespace Tariffs;

class StudentsTariff extends AbstractTariff
{
    protected $name = 'Студенческий';
    protected $pricePerKm = 4;
    protected $pricePerMin = 1;
    protected $maxAge = 25;
    protected $secondDriverTraitAvailable = false;
}
