<?php

/**
 * Booking filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBookingFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hotel_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => true)),
      'date_arrival'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'date_departure'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'adults'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'children'          => new sfWidgetFormFilterInput(),
      'nights'            => new sfWidgetFormFilterInput(),
      'guest_name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'guest_email'       => new sfWidgetFormFilterInput(),
      'guest_telephone'   => new sfWidgetFormFilterInput(),
      'guest_wish'        => new sfWidgetFormFilterInput(),
      'price'             => new sfWidgetFormFilterInput(),
      'summary'           => new sfWidgetFormFilterInput(),
      'hash'              => new sfWidgetFormFilterInput(),
      'payment_status'    => new sfWidgetFormChoice(array('choices' => array('' => '', 'pending' => 'pending', 'paid' => 'paid', 'cancelled' => 'cancelled', 'nopayment' => 'nopayment'))),
      'lang'              => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'is_backend_viewed' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'hotel_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hotel'), 'column' => 'id')),
      'date_arrival'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_departure'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'adults'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'children'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nights'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'guest_name'        => new sfValidatorPass(array('required' => false)),
      'guest_email'       => new sfValidatorPass(array('required' => false)),
      'guest_telephone'   => new sfValidatorPass(array('required' => false)),
      'guest_wish'        => new sfValidatorPass(array('required' => false)),
      'price'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'summary'           => new sfValidatorPass(array('required' => false)),
      'hash'              => new sfValidatorPass(array('required' => false)),
      'payment_status'    => new sfValidatorChoice(array('required' => false, 'choices' => array('pending' => 'pending', 'paid' => 'paid', 'cancelled' => 'cancelled', 'nopayment' => 'nopayment'))),
      'lang'              => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'is_backend_viewed' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('booking_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function getModelName()
  {
    return 'Booking';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'hotel_id'          => 'ForeignKey',
      'date_arrival'      => 'Date',
      'date_departure'    => 'Date',
      'adults'            => 'Number',
      'children'          => 'Number',
      'nights'            => 'Number',
      'guest_name'        => 'Text',
      'guest_email'       => 'Text',
      'guest_telephone'   => 'Text',
      'guest_wish'        => 'Text',
      'price'             => 'Number',
      'summary'           => 'Text',
      'hash'              => 'Text',
      'payment_status'    => 'Enum',
      'lang'              => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'is_backend_viewed' => 'Boolean',
    );
  }
}
