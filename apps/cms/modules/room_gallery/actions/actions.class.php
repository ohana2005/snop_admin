<?php

require_once dirname(__FILE__).'/../lib/room_galleryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/room_galleryGeneratorHelper.class.php';

/**
 * room_gallery actions.
 *
 * @package    cms
 * @subpackage room_gallery
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class room_galleryActions extends autoRoom_galleryActions
{
    public function preExecute()
    {
        parent::preExecute();
        $filters = $this->getFilters();
        if(empty($filters['room_category_id'])){
            return $this->redirect('room_category/index');
        }
    }

    public function executeNew(sfWebRequest $request)
    {
        parent::executeNew($request);

        $filters = $this->getFilters();
        $this->form->setDefault('room_category_id', $filters['room_category_id']);
    }
}
