<?php

class Partner
{
	public $canDeliverySaturday;
	public $canDeliverySunday;
	public $ecomonyDays;

	public function	__construct($canDeliverySaturday = false, $canDeliverySunday = false, $ecomonyDays = 2)
	{
		$this->canDeliverySaturday = $canDeliverySaturday;
		$this->canDeliverySunday = $canDeliverySunday;
		$this->ecomonyDays = $ecomonyDays;
	}
}
