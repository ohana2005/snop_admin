<?php

/**
 * BookingRoom filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBookingRoomFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hotel_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => true)),
      'booking_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Booking'), 'add_empty' => true)),
      'room_category_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoomCategory'), 'add_empty' => true)),
      'room_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Room'), 'add_empty' => true)),
      'room_category_name' => new sfWidgetFormFilterInput(),
      'room_number'        => new sfWidgetFormFilterInput(),
      'price'              => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'hotel_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hotel'), 'column' => 'id')),
      'booking_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Booking'), 'column' => 'id')),
      'room_category_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RoomCategory'), 'column' => 'id')),
      'room_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Room'), 'column' => 'id')),
      'room_category_name' => new sfValidatorPass(array('required' => false)),
      'room_number'        => new sfValidatorPass(array('required' => false)),
      'price'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('booking_room_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function getModelName()
  {
    return 'BookingRoom';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'hotel_id'           => 'ForeignKey',
      'booking_id'         => 'ForeignKey',
      'room_category_id'   => 'ForeignKey',
      'room_id'            => 'ForeignKey',
      'room_category_name' => 'Text',
      'room_number'        => 'Text',
      'price'              => 'Number',
    );
  }
}
