<?php

/**
 * Hotel form base class.
 * sfDoctrineFormGenerator 
 * @method Hotel getObject() Returns the current form's model object
 *
 * @package    cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
   
   
   
 
abstract class BaseHotelForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
       
            
            
              'id'            => new sfWidgetFormInputHidden(),
      
        
        
       
            
            
              'admin_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Admin'), 'add_empty' => true)),
      
        
        
       
            
            
              'name'          => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'apihash'       => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'admin_lang'    => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'booking_langs' => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'slug'          => new sfWidgetFormInputText(),
      
        
        
    ));

    $this->setValidators(array(
            
              'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
                  
              'admin_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Admin'), 'required' => false)),
                  
              'name'          => new sfValidatorString(array('max_length' => 255)),
                  
              'apihash'       => new sfValidatorString(array('max_length' => 40, 'required' => false)),
                  
              'admin_lang'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
                  
              'booking_langs' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
                  
              'slug'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
          ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Hotel', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('hotel[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
           
           
     
         
  }

  public function getModelName()
  {
    return 'Hotel';
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
