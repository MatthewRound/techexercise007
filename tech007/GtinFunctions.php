<?php namespace tech007;

/**
 * Holds the class tech007/GtinFunctions.php
 *
 * PHP version 5
 *
 * @category Core
 * @package  tech007
 * @author   Matthew Round <roundyz32@gmail.com>
 * @license  (All rights and ownership reserved)
 * @link
 *
 */


/**
 * GtinFunctions
 *
 * Determines and applies a gtin check number
 *
 * @uses      CommonFunctions
 * @package   tech007
 * @version   1.0
 * @copyright 2016
 * @author    Matthew Round <roundyz32@gmail.com>
 * @license   All rights and ownership reserved
 */
class GtinFunctions extends CommonFunctions
{



    /**
     * gtinCheckDigit
     *
     * The gtin determined check digit
     *
     * @var string
     * @access public
     */
    public $gtinCheckDigit;


    /**
     * gtinWithCheckDigit
     *
     * The gtin with check digit applied
     *
     * @var string
     * @access public
     */
    public $gtinWithCheckDigit;


    /**
     * determine
     *
     * Algorithm taken from http://www.gs1.org/how-calculate-check-digit-manually
     *
     * @param long int $gtin The gtin number
     * @access public
     * @return bool
     */
    public function determine($gtin = null)
    {
        $ret = false;
        if ($gtin !== null) {
            $gtinLength = strlen($gtin);
            $gtinLengthIsValid
                = ($gtinLength == 7) || ($gtinLength == 11) || ($gtinLength == 12) || ($gtinLength == 13);
            if ($gtinLengthIsValid) {
                $ns = str_split((string)$gtin);
                $multiplier = 3;
                $sums = [];
                for ($i = $gtinLength -1; $i >=0; $i--) {
                    $currentDigit = $ns[$i];
                    $sums[$i] = (int)$currentDigit * $multiplier;
                    if ($multiplier == 3) {
                        $multiplier = 1;
                    } else {
                        $multiplier = 3;
                    }
                }
                $sum = 0;
                foreach (array_reverse($sums) as $sumNum) {
                    $sum += $sumNum;
                }
                $nearestTen = round($sum, -1);
                if ($nearestTen < $sum) {
                    $nearestTen = $nearestTen + 10;
                }
                $gtinCheckDigit = $nearestTen - $sum;
                $this->gtinCheckDigit = $gtinCheckDigit;
                $this->gtinWithCheckDigit = $gtin . $gtinCheckDigit;
                if ($gtinCheckDigit > 0) {
                    $ret = true;
                } else {
                    $this->lastError = "invalid check digit determined";
                }
            } else {
                $this->lastError = "invalid length of gtin";
            }
        }
        return $ret;
    }
}
