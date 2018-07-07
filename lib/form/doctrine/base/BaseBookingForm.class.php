<?php

/**
 * Booking form base class.
 * sfDoctrineFormGenerator 
 * @method Booking getObject() Returns the current form's model object
 *
 * @package    cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
   
   
   
 
abstract class BaseBookingForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
       
            
            
              'id'                => new sfWidgetFormInputHidden(),
      
        
        
       
            
            
              'hotel_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => false)),
      
        
        
       
            
            
              'date_arrival'      => new sfWidgetFormDate(),
      
        
        
       
            
            
              'date_departure'    => new sfWidgetFormDate(),
      
        
        
       
            
            
              'adults'            => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'children'          => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'nights'            => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'guest_name'        => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'guest_email'       => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'guest_telephone'   => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'guest_wish'        => new sfWidgetFormTextarea(),
      
        
        
       
            
            
              'price'             => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'summary'           => new sfWidgetFormTextarea(),
      
        
        
       
            
            
              'hash'              => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'payment_status'    => new sfWidgetFormChoice(array('choices' => array('pending' => 'pending', 'paid' => 'paid', 'cancelled' => 'cancelled', 'nopayment' => 'nopayment'))),
      
        
        
       
            
            
              'created_at'        => new sfWidgetFormDateTime(),
      
        
        
       
            
            
              'updated_at'        => new sfWidgetFormDateTime(),
      
        
        
       
            
            
              'is_backend_viewed' => new sfWidgetFormInputCheckbox(),
      
        
        
    ));

    $this->setValidators(array(
            
              'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
                  
              'hotel_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'))),
                  
              'date_arrival'      => new sfValidatorDate(),
                  
              'date_departure'    => new sfValidatorDate(),
                  
              'adults'            => new sfValidatorInteger(),
                  
              'children'          => new sfValidatorInteger(array('required' => false)),
                  
              'nights'            => new sfValidatorInteger(array('required' => false)),
                  
              'guest_name'        => new sfValidatorString(array('max_length' => 255)),
                  
              'guest_email'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
                  
              'guest_telephone'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
                  
              'guest_wish'        => new sfValidatorString(array('required' => false)),
                  
              'price'             => new sfValidatorNumber(array('required' => false)),
                  
              'summary'           => new sfValidatorString(array('required' => false)),
                  
              'hash'              => new sfValidatorString(array('max_length' => 40, 'required' => false)),
                  
              'payment_status'    => new sfValidatorChoice(array('choices' => array(0 => 'pending', 1 => 'paid', 2 => 'cancelled', 3 => 'nopayment'), 'required' => false)),
                  
              'created_at'        => new sfValidatorDateTime(),
                  
              'updated_at'        => new sfValidatorDateTime(),
                  
              'is_backend_viewed' => new sfValidatorBoolean(array('required' => false)),
          ));

    $this->widgetSchema->setNameFormat('booking[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
           
         unset($this['created_at'], $this['updated_at']);
           
     
         
  }

  public function getModelName()
  {
    return 'Booking';
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
