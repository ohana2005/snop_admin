<?php

/**
 * PackageItem filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePackageItemFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hotel_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => true)),
      'name'          => new sfWidgetFormFilterInput(),
      'per_period'    => new sfWidgetFormChoice(array('choices' => array('' => '', 'day' => 'day', 'booking' => 'booking'))),
      'per_person'    => new sfWidgetFormChoice(array('choices' => array('' => '', 'room' => 'room', 'person' => 'person', 'adult' => 'adult', 'child' => 'child'))),
      'is_discount'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'packages_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Package')),
    ));

    $this->setValidators(array(
      'hotel_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hotel'), 'column' => 'id')),
      'name'          => new sfValidatorPass(array('required' => false)),
      'per_period'    => new sfValidatorChoice(array('required' => false, 'choices' => array('day' => 'day', 'booking' => 'booking'))),
      'per_person'    => new sfValidatorChoice(array('required' => false, 'choices' => array('room' => 'room', 'person' => 'person', 'adult' => 'adult', 'child' => 'child'))),
      'is_discount'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'packages_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Package', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('package_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function addPackagesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.PackageItem2Package PackageItem2Package')
      ->andWhereIn('PackageItem2Package.package_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'PackageItem';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'hotel_id'      => 'ForeignKey',
      'name'          => 'Text',
      'per_period'    => 'Enum',
      'per_person'    => 'Enum',
      'is_discount'   => 'Boolean',
      'packages_list' => 'ManyKey',
    );
  }
}
