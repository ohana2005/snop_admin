<?php

/**
 * hotel actions.
 *
 * @package    cms
 * @subpackage hotel
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 23810 2009-11-12 11:07:44Z Alex.Radyuk $
 */
require_once sfConfig::get('sf_cache_dir') . '/' 
        . sfContext::getInstance()->getConfiguration()->getApplication() . '/'
        . sfConfig::get('sf_environment') . '/'
        . 'modules/autoHotel/actions/components.class.php';

class hotelComponents extends autoHotelComponents
{
}