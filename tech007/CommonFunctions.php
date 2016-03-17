<?php namespace tech007;

/**
 * Holds the class tech007/CommonFunctions.php
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
 * CommonFunctions
 *
 * @abstract
 * @package   tech007
 * @version   1.0
 * @copyright 2016
 * @author    Matthew Round <roundyz32@gmail.com>
 * @license   All rights and ownership reserved
 */
abstract class CommonFunctions
{


    /**
     * lastError
     *
     * Holds the last error
     *
     * @var string
     * @access public
     */
    public $lastError;


    /**
     * determine
     *
     * Actually does the function
     *
     * @param mixed $ob
     * @abstract
     * @access public
     * @return bool
     */
    abstract public function determine($ob = null);
}


include "GtinFunctions.php";
include "DeliveryFunctions.php";
