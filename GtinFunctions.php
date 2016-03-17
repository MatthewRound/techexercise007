<?php


class GtinFunctions extends CommonFunctions
{


	public $gtinCheckDigit;
	public $gtinWithCheckDigit;

	// calcuate gtin check digit for either 7, 11, 12 or 13 long int
	// create full gtin 8, 12, 13, or 14
	// algorithm taken from http://www.gs1.org/how-calculate-check-digit-manually
	public function determine($gtin = null)
	{
		$ret = false;
		if ($gtin !== null) {
			$gtinLength = strlen($gtin);
			$gtinLengthIsValid = ($gtinLength == 7) || ($gtinLength == 11) || ($gtinLength == 12) || ($gtinLength == 13);
			if ($gtinLengthIsValid) {
				$ns = str_split((string)$gtin);
				$multiplier = 3;
				$sums = [];
				for ($i = $gtinLength -1; $i >=0; $i--) {
					$currentDigit = $ns[$i];
					$sums[$i] = (int)$currentDigit * $multiplier; 
					//reset multiplier for next digit
					if ($multiplier == 3) {
						$multiplier = 1;
					} else {
						$multiplier = 3;
					}
				}
				$sum = 0;
				foreach (array_reverse($sums) as $sumNum)  {
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
