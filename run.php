<?php
/**
 * Holds the instruction on how to utilise the common function classes
 *
 * PHP version 5
 *
 * @category Core
 * @package  run.php
 * @author   Matthew Round <roundyz32@gmail.com>
 * @license  (All rights and ownership reserved)
 * @link
 *
 */

include_once "tech007/CommonFunctions.php";

use \tech007\DeliveryFunctions as DeliveryFunctions;
use \tech007\GtinFunctions as GtinFunctions;
use \tech007\Partner as Partner;

// gtin check
$gtin = new GtinFunctions();
$gtin13 = 629104150021;
$res = $gtin->determine($gtin13);
if ($res) {
    printf("\nGtin-13 %s : with check digit: %s\n\n", $gtin13, $gtin->gtinWithCheckDigit);
} else {
    echo $df->lastError;
}


// next day delivery
$df = DeliveryFunctions::buildFromPartner(new Partner($_deliversSaturday = false, $_deliversSunday = false, 5));
$date = new DateTime('18-03-2016'); // friday
if ($df->determine(clone $date)) {
    $format = 'j (D)-m-Y';
    $a = $date->format($format);
    $b = $df->ndd->format($format);
    $c = $df->eco->format($format);
    printf("\nDate:\t%s\nndd:\t%s\neco:\t%s [+%d days]", $a, $b, $c, $df->partner->ecomonyDays);
} else {
    echo $df->lastError;
}
