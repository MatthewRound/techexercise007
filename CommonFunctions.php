<?php

abstract class CommonFunctions
{
	public $lastError;
	public abstract function determine($ob = null);
}

include "GtinFunctions.php";
include "DeliveryFunctions.php";
