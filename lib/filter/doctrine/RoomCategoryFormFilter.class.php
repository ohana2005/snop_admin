<?php

/**
 * RoomCategory filter form.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RoomCategoryFormFilter extends BaseRoomCategoryFormFilter
{
  public function configure()
  {
      $this->widgetSchema['name'] = new sfWidgetFormInputText;
      $this->validatorSchema['name'] = new sfValidatorString(['required' => false]);
  }
}
