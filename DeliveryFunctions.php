<?php

include "Partner.php";

class DeliveryFunctions extends CommonFunctions
{


	public $ndd = null;
	public $eco = null;
	public $partner = null;


	public static function buildFromPartner($partner)
	{
		$a = new self();
		$a->partner = $partner;
		return $a;
	}


	public function determine($ob = null)
	{
		$ret = false;
		if ($ob !== null) {
			$clone = clone $ob;
			$this->ndd = $this->determineDate($ob);
			$this->eco = $this->determineDate($clone, $this->partner->ecomonyDays -1);
			$ret = true;
		}
		return $ret;
	}


	private function determineDate($date, $advanceDays = 0)
	{
		$nextDate = $date->add(DateInterval::createFromDateString('+'.$advanceDays.' days'));
		$nextDay = $nextDate->format('l'); //MONDAY
		$ret = null;
		$nextWorkingDay = array_search($nextDay, ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
		// will cover the weekend
		if ($nextWorkingDay >= 4) {
			$isFriday = $nextWorkingDay == 4;
			if ($isFriday) { 
				if ($this->partner->canDeliverySaturday) {
					$ret = $nextDate->add(DateInterval::createFromDateString('+1 day'));
				} elseif ($this->partner->canDeliverySunday) {
					$ret = $nextDate->add(DateInterval::createFromDateString('+2 days'));
				} else {
					$ret = $nextDate->add(DateInterval::createFromDateString('+3 days'));
				}
			}
			$isSaturday = $nextWorkingDay == 5;
			if ($isSaturday) { //saturday
				if ($this->partner->canDeliverySunday) {
					$ret = $nextDate->add(DateInterval::createFromDateString('+1 day'));
				} else {
					$ret = $nextDate->add(DateInterval::createFromDateString('+2 days'));
				}
			}
			$isSunday = $nextWorkingDay == 6;
			if ($isSunday) { //sunday
				$ret = $nextDate->add(DateInterval::createFromDateString('+1 day'));
			}
		} else {
			$ret = $nextDate->add(DateInterval::createFromDateString('+1 day'));
		}
		return $ret;
	}
}
