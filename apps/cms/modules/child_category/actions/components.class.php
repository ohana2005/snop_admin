<?php

/**
 * child_category actions.
 *
 * @package    cms
 * @subpackage child_category
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 23810 2009-11-12 11:07:44Z Alex.Radyuk $
 */
require_once sfConfig::get('sf_cache_dir') . '/' 
        . sfContext::getInstance()->getConfiguration()->getApplication() . '/'
        . sfConfig::get('sf_environment') . '/'
        . 'modules/autoChild_category/actions/components.class.php';

class child_categoryComponents extends autoChild_categoryComponents
{
}