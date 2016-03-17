<?php namespace tech007;

/**
 * Holds the class tech007/Partner.php
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
 * Partner
 *
 * Represents a delivery partner
 *
 * @package   tech007
 * @version   1.0
 * @copyright 2016
 * @author    Matthew Round <roundyz32@gmail.com>
 * @license   All rights and ownership reserved
 */
class Partner
{

    /**
     * canDeliverySaturday
     *
     * @var bool
     * @access public
     */
    public $canDeliverySaturday;


    /**
     * canDeliverySunday
     *
     * @var bool
     * @access public
     */
    public $canDeliverySunday;


    /**
     * ecomonyDays
     *
     * Days for an ecomony delivery
     *
     * @var int
     * @access public
     */
    public $ecomonyDays;


    /**
     * __construct
     *
     * Constructs self.
     *
     * @param bool $canDeliverySaturday
     * @param bool $canDeliverySunday
     * @param int  $ecomonyDays
     *
     * @access public
     * @return void
     */
    public function __construct($canDeliverySaturday = false, $canDeliverySunday = false, $ecomonyDays = 2)
    {
        $this->canDeliverySaturday = $canDeliverySaturday;
        $this->canDeliverySunday = $canDeliverySunday;
        $this->ecomonyDays = $ecomonyDays;
    }
}
