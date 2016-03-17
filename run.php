<?php
include_once "CommonFunctions.php";

$cf = new CommonFunctions();

$gtin13 = 629104150021;
$res = $cf->calcuateGTINCheckDigit($gtin13);

if ($res) {
	printf("Gtin-13 %s : with check digit: %s", $gtin13, $cf->gtinCheckDigit);
}
