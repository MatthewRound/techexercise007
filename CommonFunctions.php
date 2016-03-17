<?php



class CommonFunctions
{


	public $gtinCheckDigit;
	public $gtinWithCheckDigit;


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
			$this->gtinWithCheckDigit = $gtin . $gtinCheckDigit;
			if ($gtinCheckDigit > 0) {
				$ret = true;
			}
		}
		return $ret;
	}


private $canDeliverySaturday = false;
private $canDeliverySunday = false;
private $ecomonyDays = 2;

public $nextDayDelivery = null;
public $ecomonyDayDelivery = null;
public $dates = [
'Monday',
'Tuesday',
'Wednesday',
'Thursday',
'Friday',
'Saturday',
'Sunday'
];

/* can only deliver on working days */
/* saturday and sunday are not working days */
/* but are for partners */
/* assumed date is a validate Date class */
	public function calculateDeliveryDates($date = null)
	{
		$ret = false;
		if ($date !== null) {
			//TODO calc next working day
			$this->nextDayDelivery = $this->determineNextDate($date, 0);

			//TODO fix this next ecomony day
			$this->ecomonyDayDelivery = $this->determineNextDate($date, $this->ecomonyDays);
			$ret = true;
		}
		return $ret;
	}


	private function determineNextDate($date, $offset = 0)
	{
		$currentDay = $date->format('l');
		$ret = $date;
		$nextWorkingDay = array_search($currentDay, $this->dates);
		// will cover the weekend
		if ($nextWorkingDay >= 4) {
			if ($nextWorkingDay == 4) { // friday
				if ($this->canDeliverySaturday) {
					$ret = $date->add(DateInterval::createFromDateString('+'. (1+ $offset) .' day'));
				} elseif ($this->canDeliverySunday) {
					$ret = $date->add(DateInterval::createFromDateString('+' . (2 + $offset) .'days'));
				} else {
					$ret = $date->add(DateInterval::createFromDateString('+' . (3 + $offset) .'days'));
				}
			}
			if ($nextWorkingDay == 5) { //saturday
				if ($this->canDeliverySunday) {
					$ret = $date->add(DateInterval::createFromDateString('+'. (1+ $offset) .' day'));
				} else {
					$ret = $date->add(DateInterval::createFromDateString('+' . (2 + $offset) .'days'));
				}
			}
			if ($nextWorkingDay == 6) { //sunday
				$ret = $date->add(DateInterval::createFromDateString('+'. (1+ $offset) .' day'));
			}
		} else {

			$ret = $date->add(DateInterval::createFromDateString('+'. (1+ $offset) .' day'));
		}
		return $ret;
	}

}
