<?php

namespace Tariffs\Logger;

class HtmlLogger extends AbstractLogger
{
    public function printLog()
    {
        echo '<hr>';
        echo 'Указанный тариф: ' . $this->getTariffName() . '<br>';
        echo 'Цена за поездку: ' . $this->getDrivePrice() . ' руб.<br>';
        echo '<hr>';
    }
}
