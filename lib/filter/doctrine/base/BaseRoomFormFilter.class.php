<?php

/**
 * Room filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRoomFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hotel_id'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'room_category_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoomCategory'), 'add_empty' => true)),
      'number'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'hotel_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'room_category_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RoomCategory'), 'column' => 'id')),
      'number'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('room_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function getModelName()
  {
    return 'Room';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'hotel_id'         => 'Number',
      'room_category_id' => 'ForeignKey',
      'number'           => 'Text',
    );
  }
}
