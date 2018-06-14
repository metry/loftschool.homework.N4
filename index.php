<?php
require_once "autoload.php";
spl_autoload_register('autoload');

$obj1 = new Tariffs\HoursTariff();
$obj1->setAge(22);
$obj1->setDriveDistanceKm(10);
$obj1->setDriveTimeMinutes(61);
//$obj1->setTraits(['gps','second driver','nonono']); //вернет исключение
$obj1->setTraits(['second driver', 'gps']);

try {
    $obj1->isValid();
    $obj1->checkAge();
    $obj1->checkTraitsNames();

    $logger = new \Tariffs\Logger\HtmlLogger();
    $logger->setTariffName($obj1::TARIF_NAME);
    $logger->setDrivePrice($obj1->getDrivePrice());
    $logger->isValid();
    $logger->printLog();

} catch (Exception $e) {
    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}
