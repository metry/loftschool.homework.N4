<?php
require 'src/SecondDriverTrait.php';
require 'src/GpsTrait.php';
require 'src/TariffsInterface.php';
require 'src/AbstractTariff.php';
require 'src/BasicTariff.php';
require 'src/StudentsTariff.php';
require 'src/HoursTariff.php';
require 'src/DayTariff.php';

echo '<h1>Базовый</h1>';
new Tariffs\BasicTariff(10, 60, 20);
new Tariffs\BasicTariff(20, 125, 25, ['gps','second driver']);
new Tariffs\BasicTariff(10, 60, 15);

echo '<h1>Студенческий</h1>';
new Tariffs\StudentsTariff(10, 60, 20, ['gps','second driver']);
new Tariffs\StudentsTariff(20, 125, 40); //Возраст водителя не может быть более 25 лет
new Tariffs\StudentsTariff(10, 60, 15);

echo '<h1>Почасовой</h1>';
new Tariffs\HoursTariff(10, 60, 20, ['gps','second driver']);
new Tariffs\HoursTariff(20, 125, 40); //Округление до 60 минут в большую сторону
new Tariffs\HoursTariff(10, 60, 15);

echo '<h1>Суточный</h1>';
new Tariffs\DayTariff(10, 60, 20, ['gps','second driver']);
new Tariffs\DayTariff(10, 1470, 20); //округление до 24 часов в большую сторону,  но не менее 30 минут
new Tariffs\DayTariff(20, 1471, 40); //округление до 24 часов в большую сторону,  но не менее 30 минут
new Tariffs\DayTariff(10, 60, 15);
