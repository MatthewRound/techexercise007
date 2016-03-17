<?php
include_once "CommonFunctions.php";


//gtin check
$cf = new CommonFunctions();
$gtin13 = 629104150021;
$res = $cf->calcuateGTINCheckDigit($gtin13);
/* if ($res) { */
/* 	printf("Gtin-13 %s : with check digit: %s", $gtin13, $cf->gtinWithCheckDigit); */
/* } */


//calc next day delivery
$cf = new CommonFunctions();
$date = new DateTime();
$res = $cf->calculateDeliveryDates($date);
$format = 'D-m-y';
if ($res) {
	$a = $date->format($format);
	$b = $cf->nextDayDelivery->format($format);
	$c = $cf->ecomonyDayDelivery->format($format);
	printf("Day = %s, nextDay = %s, eco= %s", $a, $b, $c);
}
