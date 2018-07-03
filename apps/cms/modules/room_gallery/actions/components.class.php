<?php

/**
 * room_gallery actions.
 *
 * @package    cms
 * @subpackage room_gallery
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 23810 2009-11-12 11:07:44Z Alex.Radyuk $
 */
require_once sfConfig::get('sf_cache_dir') . '/' 
        . sfContext::getInstance()->getConfiguration()->getApplication() . '/'
        . sfConfig::get('sf_environment') . '/'
        . 'modules/autoRoom_gallery/actions/components.class.php';

class room_galleryComponents extends autoRoom_galleryComponents
{
}