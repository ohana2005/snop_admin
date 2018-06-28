<?php

/**
 * RoomOccupancy filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRoomOccupancyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hotel_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => true)),
      'room_occupancy_entity_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoomOccupancyEntity'), 'add_empty' => true)),
      'room_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Room'), 'add_empty' => true)),
      'booking_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Booking'), 'add_empty' => true)),
      'info'                     => new sfWidgetFormFilterInput(),
      'date'                     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'is_arrival'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_departure'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_occupied'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_closed'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'hotel_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hotel'), 'column' => 'id')),
      'room_occupancy_entity_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RoomOccupancyEntity'), 'column' => 'id')),
      'room_id'                  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Room'), 'column' => 'id')),
      'booking_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Booking'), 'column' => 'id')),
      'info'                     => new sfValidatorPass(array('required' => false)),
      'date'                     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'is_arrival'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_departure'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_occupied'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_closed'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('room_occupancy_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function getModelName()
  {
    return 'RoomOccupancy';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'hotel_id'                 => 'ForeignKey',
      'room_occupancy_entity_id' => 'ForeignKey',
      'room_id'                  => 'ForeignKey',
      'booking_id'               => 'ForeignKey',
      'info'                     => 'Text',
      'date'                     => 'Date',
      'is_arrival'               => 'Boolean',
      'is_departure'             => 'Boolean',
      'is_occupied'              => 'Boolean',
      'is_closed'                => 'Boolean',
    );
  }
}
