<?php

/**
 * hotel_config actions.
 *
 * @package    cms
 * @subpackage hotel_config
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 23810 2009-11-12 11:07:44Z Alex.Radyuk $
 */
require_once sfConfig::get('sf_cache_dir') . '/' 
        . sfContext::getInstance()->getConfiguration()->getApplication() . '/'
        . sfConfig::get('sf_environment') . '/'
        . 'modules/autoHotel_config/actions/components.class.php';

class hotel_configComponents extends autoHotel_configComponents
{
}