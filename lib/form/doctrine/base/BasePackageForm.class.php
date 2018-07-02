<?php

/**
 * Package form base class.
 * sfDoctrineFormGenerator 
 * @method Package getObject() Returns the current form's model object
 *
 * @package    cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
   
   
   
 
abstract class BasePackageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
       
            
            
              'id'                 => new sfWidgetFormInputHidden(),
      
        
        
       
            
            
              'hotel_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => false)),
      
        
        
       
            
            
              'name'               => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'description'        => new sfWidgetFormTextarea(),
      
        
        
       
            
            
              'min_stay'           => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'max_stay'           => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'min_adults'         => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'max_adults'         => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'min_children'       => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'max_children'       => new sfWidgetFormInputText(),
      
        
        
      'package_items_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'PackageItem')),
    ));

    $this->setValidators(array(
            
              'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
                  
              'hotel_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'))),
                  
              'name'               => new sfValidatorString(array('max_length' => 255)),
                  
              'description'        => new sfValidatorString(array('required' => false)),
                  
              'min_stay'           => new sfValidatorInteger(array('required' => false)),
                  
              'max_stay'           => new sfValidatorInteger(array('required' => false)),
                  
              'min_adults'         => new sfValidatorInteger(array('required' => false)),
                  
              'max_adults'         => new sfValidatorInteger(array('required' => false)),
                  
              'min_children'       => new sfValidatorInteger(array('required' => false)),
                  
              'max_children'       => new sfValidatorInteger(array('required' => false)),
            'package_items_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'PackageItem', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('package[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
           
           
     
         
  }

  public function getModelName()
  {
    return 'Package';
  }
    public function updateObject($values = null)
    {
        $object = parent::updateObject($values);
                return $object;
    }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();
    foreach($this->embeddedTextBlocks as $block_name){
        $TextBlock = Q::c('TextBlock', 'b')
            ->where('b.special_mark = ?', $block_name)
            ->fetchOne();
        if($TextBlock){
            $this->setDefault($block_name, $TextBlock->text);
        }
    }    
        if (isset($this->widgetSchema['package_items_list']))
    {
      $this->setDefault('package_items_list', $this->object->PackageItems->getPrimaryKeys());
    }

  }
  
  public function savePackageItemsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['package_items_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->PackageItems->getPrimaryKeys();
    $values = $this->getValue('package_items_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('PackageItems', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('PackageItems', array_values($link));
    }
  }

  
  

  protected function doSave($con = null)
  {
    
    $this->savePackageItemsList($con);
        
    
    parent::doSave($con);
    
    foreach($this->embeddedTextBlocks as $block_name){
        $TextBlock = Q::c('TextBlock', 'b')
            ->where('b.special_mark = ?', $block_name)
            ->fetchOne();
        if($TextBlock){
            $TextBlock->text = $this->values[$block_name];
            $TextBlock->save();
        }
    }
  }



}
