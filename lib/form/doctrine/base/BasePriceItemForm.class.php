<?php

/**
 * PriceItem form base class.
 * sfDoctrineFormGenerator 
 * @method PriceItem getObject() Returns the current form's model object
 *
 * @package    cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
   
   
   
 
abstract class BasePriceItemForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
       
            
            
              'id'               => new sfWidgetFormInputHidden(),
      
        
        
       
            
            
              'price_item_type'  => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'hotel_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => false)),
      
        
        
       
            
            
              'date'             => new sfWidgetFormDate(),
      
        
        
       
            
            
              'price'            => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'room_category_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoomCategory'), 'add_empty' => true)),
      
        
        
       
            
            
              'package_item_id'  => new sfWidgetFormInputText(),
      
        
        
    ));

    $this->setValidators(array(
            
              'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
                  
              'price_item_type'  => new sfValidatorInteger(),
                  
              'hotel_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'))),
                  
              'date'             => new sfValidatorDate(),
                  
              'price'            => new sfValidatorNumber(array('required' => false)),
                  
              'room_category_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RoomCategory'), 'required' => false)),
                  
              'package_item_id'  => new sfValidatorInteger(array('required' => false)),
          ));

    $this->widgetSchema->setNameFormat('price_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
           
           
     
         
  }

  public function getModelName()
  {
    return 'PriceItem';
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
      }
  

  protected function doSave($con = null)
  {
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
