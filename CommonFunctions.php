<?php



class CommonFunctions
{


	public $gtinCheckDigit;


	// calcuate gtin check digit for either 7, 11, 12 or 13 long int
	// create full gtin 8, 12, 13, or 14
	//formula taken from http://www.gs1.org/how-calculate-check-digit-manually
	public function calcuateGTINCheckDigit($gtin = null)
	{
		$ret = false;
		if ($gtin !== null) {
			$gtinLength = strlen($gtin);
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
			$gtinCheckDigit = $nearestTen - $sum;
			$this->gtinCheckDigit = $gtin . $gtinCheckDigit;
			if ($gtinCheckDigit > 0) {
				$ret = true;
			}
		}
		return $ret;
	}

/* can only deliver on working days */
/* saturday and sunday are not working days */
/* but are for partners */
	public function calculateDeliveryDates($date = null)
	{
		$ret = false;
		return $ret;
	}
}
