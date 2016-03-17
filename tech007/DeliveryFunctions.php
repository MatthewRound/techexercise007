<?php namespace tech007;

/**
 * Holds the class tech007/DeliveryFunctions.php
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


include "Partner.php";


/**
 * DeliveryFunctions
 *
 * Determines next day and ecomony delivery dates.
 *
 * @uses      CommonFunctions
 * @package   tech007
 * @version   1.0
 * @copyright 2016
 * @author    Matthew Round <roundyz32@gmail.com>
 * @license   All rights and ownership reserved
 */
class DeliveryFunctions extends CommonFunctions
{


    /**
     * ndd
     *
     * The next day delivery date
     *
     * @var \DateTime
     * @access public
     */
    public $ndd = null;


    /**
     * eco
     *
     * The ecomony date
     *
     * @var \DateTime
     * @access public
     */
    public $eco = null;


    /**
     * partner
     *
     * The partner who is to deliver
     *
     * @var \tech007\Partner
     * @access public
     */
    public $partner = null;


    /**
     * buildFromPartner
     *
     * Builds an instance from a partner
     *
     * @param \tech007\Partner $partner The partner to use
     * @static
     * @access public
     * @return \tech007\DeliveryFunctions
     */
    public static function buildFromPartner($partner)
    {
        $a = new self();
        $a->partner = $partner;
        return $a;
    }


    /**
     * determine
     *
     * Actually does the function
     *
     * @param /DateTime $ob instance
     * @access public
     * @return bool
     */
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


    /**
     * determineDate
     *
     * Actually detemines the delivery date
     *
     * @param \DateTime $date The date to determine from
     * @param int $advanceDays How many days to advance
     * @access private
     * @return \DateTime
     */
    private function determineDate($date, $advanceDays = 0)
    {
        $nextDate = $date->add(\DateInterval::createFromDateString('+'.$advanceDays.' days'));
        $nextDay = $nextDate->format('l'); //DAY NAME
        $ret = null;
        $nextWorkingDay = array_search(
            $nextDay,
            ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
        );
        $willCoverWeekend = $nextWorkingDay >= 4;
        if ($willCoverWeekend) {
            $isFriday = $nextWorkingDay == 4;
            if ($isFriday) {
                if ($this->partner->canDeliverySaturday) {
                    $ret = $nextDate->add(\DateInterval::createFromDateString('+1 day'));
                } elseif ($this->partner->canDeliverySunday) {
                    $ret = $nextDate->add(\DateInterval::createFromDateString('+2 days'));
                } else {
                    $ret = $nextDate->add(\DateInterval::createFromDateString('+3 days'));
                }
            }
            $isSaturday = $nextWorkingDay == 5;
            if ($isSaturday) {
                if ($this->partner->canDeliverySunday) {
                    $ret = $nextDate->add(\DateInterval::createFromDateString('+1 day'));
                } else {
                    $ret = $nextDate->add(\DateInterval::createFromDateString('+2 days'));
                }
            }
            $isSunday = $nextWorkingDay == 6;
            if ($isSunday) {
                $ret = $nextDate->add(\DateInterval::createFromDateString('+1 day'));
            }
        } else {
            $ret = $nextDate->add(\DateInterval::createFromDateString('+1 day'));
        }
        return $ret;
    }
}
