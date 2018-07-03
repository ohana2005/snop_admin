<?php

/**
 * text_block_cms actions.
 *
 * @package    cms
 * @subpackage text_block_cms
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 23810 2009-11-12 11:07:44Z Alex.Radyuk $
 */
require_once sfConfig::get('sf_cache_dir') . '/' 
        . sfContext::getInstance()->getConfiguration()->getApplication() . '/'
        . sfConfig::get('sf_environment') . '/'
        . 'modules/autoText_block_cms/actions/components.class.php';

class text_block_cmsComponents extends autoText_block_cmsComponents
{
}