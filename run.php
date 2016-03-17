<?php

include_once "CommonFunctions.php";

//gtin check
$gtin = new GtinFunctions();
$gtin13 = 629104150021;
$res = $gtin->determine($gtin13);
if ($res) {
	printf("\nGtin-13 %s : with check digit: %s\n\n", $gtin13, $gtin->gtinWithCheckDigit);
}


//calc next day delivery
$df = DeliveryFunctions::buildFromPartner(new Partner(false, false, 5));
$date = new DateTime('18-03-2016'); // friday 
if ($df->determine(clone $date)) {
	$format = 'j (D)-m-Y';
	$a = $date->format($format);
	$b = $df->ndd->format($format);
	$c = $df->eco->format($format);
	printf("\nDate:\t%s\nndd:\t%s\neco:\t%s [+%d days]", $a, $b, $c, $df->partner->ecomonyDays);
}
