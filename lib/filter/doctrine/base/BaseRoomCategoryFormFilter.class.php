<?php

/**
 * RoomCategory filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRoomCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hotel_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => true)),
      'adults'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'children'    => new sfWidgetFormFilterInput(),
      'min_persons' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'max_persons' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_active'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'hotel_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hotel'), 'column' => 'id')),
      'adults'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'children'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'min_persons' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'max_persons' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_active'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('room_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function getModelName()
  {
    return 'RoomCategory';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'hotel_id'    => 'ForeignKey',
      'adults'      => 'Number',
      'children'    => 'Number',
      'min_persons' => 'Number',
      'max_persons' => 'Number',
      'is_active'   => 'Boolean',
    );
  }
}
