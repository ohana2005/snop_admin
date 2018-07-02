<?php

/**
 * Package filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePackageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hotel_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => true)),
      'name'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'        => new sfWidgetFormFilterInput(),
      'min_stay'           => new sfWidgetFormFilterInput(),
      'max_stay'           => new sfWidgetFormFilterInput(),
      'min_adults'         => new sfWidgetFormFilterInput(),
      'max_adults'         => new sfWidgetFormFilterInput(),
      'min_children'       => new sfWidgetFormFilterInput(),
      'max_children'       => new sfWidgetFormFilterInput(),
      'package_items_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'PackageItem')),
    ));

    $this->setValidators(array(
      'hotel_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hotel'), 'column' => 'id')),
      'name'               => new sfValidatorPass(array('required' => false)),
      'description'        => new sfValidatorPass(array('required' => false)),
      'min_stay'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'max_stay'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'min_adults'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'max_adults'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'min_children'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'max_children'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'package_items_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'PackageItem', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('package_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function addPackageItemsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('PackageItem2Package.package_item_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Package';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'hotel_id'           => 'ForeignKey',
      'name'               => 'Text',
      'description'        => 'Text',
      'min_stay'           => 'Number',
      'max_stay'           => 'Number',
      'min_adults'         => 'Number',
      'max_adults'         => 'Number',
      'min_children'       => 'Number',
      'max_children'       => 'Number',
      'package_items_list' => 'ManyKey',
    );
  }
}
