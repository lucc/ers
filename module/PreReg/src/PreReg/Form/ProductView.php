<?php   

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PreReg\Form;

use Zend\Form\Form;
use ersEntity\Entity;

class ProductView extends Form
{
    protected $sl;
    
    public function setServiceLocator($sl) {
        $this->sl = $sl;
    }
    
    public function getServiceLocator() {
        if(!isset($this->sl)) {
            throw new \Exception('Unable to find ServiceLocator');
        }
        return $this->sl;
    }
    
    public function __construct($name = null)
    {
        
        parent::__construct('Product');
        $this->variantCounter = 0;
        $this->variants = array();
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'Product_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'Price_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        
        $formElement = array();
        $formElement['name'] = 'participant_id';
        $formElement['type'] = 'Zend\Form\Element\Select';

        $formElement['attributes']['class'] = 'form-control form-element';
        $formElement['options'] = array();
        $formElement['options']['label'] = 'Person';
        $formElement['options']['label_attributes'] = array(
            'class'  => 'media-object',
            'id' => 'participant',
        );
        $this->add($formElement);
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-primary',
            ),
        ));
    }

    public function setVariants($variants, $defaults = array()) {
        $variant_count = count($variants);
        $variant_add = 1;
        foreach($variants as $v) {
            if(is_object($v) && $v instanceof Entity\ProductVariant) {
                if($v->getOrder() != null && $v->getOrder() != 0) {
                    $this->variants[$v->getOrder()] = $v;
                } else {
                    # Make sure the variants without order number or 
                    # order number == 0 will be shown last.
                    $this->variants[$variant_count+$variant_add] = $v;
                    $variant_add++;
                }
            } else {
                $logger = $this
                    ->getServiceLocator()
                    ->get('Logger');
                $logger->warn(get_class().': object is of class '.get_class($v));
            }
        }
        $this->addVariants($defaults);
    }
    
    public function getVariantCounter() {
        return $this->variantCounter;
    }
    
    private function addVariants($defaults=array()) {
        $logger = $this
            ->getServiceLocator()
            ->get('Logger');
        $this->variantCounter = 0;
        foreach($this->variants as $variant) {
            /* Example array
             * array(
                'name' => 'birthday',
                'attributes' => array(
                    'type'  => 'text',
                    'class'  => 'datepicker',
                ),
                'options' => array(
                    'label' => 'Birthday',
                ),
            )*/
            $formElementId = array();
            $formElementId['name'] = 'variant_id_'.$this->variantCounter;
            $formElementId['attributes'] = array();
            $formElementId['attributes']['type'] = 'hidden';
            $formElementId['attributes']['value'] = $variant->getId();
            $this->add($formElementId);
            
            $formElementType = array();
            $formElementType['name'] = 'variant_type_'.$this->variantCounter;
            $formElementType['attributes'] = array();
            $formElementType['attributes']['type'] = 'hidden';
            $formElementType['attributes']['value'] = $variant->getType();
            $this->add($formElementType);
            
            $formElementValue = array();
            $formElementValue['name'] = 'variant_value_'.$this->variantCounter;
            switch(strtolower($variant->getType())) {
                case 'text':
                    $formElementValue['attributes'] = array();
                    $formElementValue['attributes']['type'] = $variant->getType();
                    $formElementValue['attributes']['class'] = 'form-control form-element';
                    if(isset($defaults[$variant->getId()])) {
                        $formElementValue['attributes']['value'] = $defaults[$variant->getId()];
                    }
            
                    $formElementValue['options'] = array();
                    $formElementValue['options']['label'] = $variant->getName();
                    $formElementValue['options']['label_attributes'] = array(
                            'class'  => 'media-object',
                        );
                    break;
                case 'date':
                    $formElementValue['attributes'] = array();
                    $formElementValue['attributes']['type'] = 'text';
                    $formElementValue['attributes']['class'] = 'form-control form-element datepicker';
                    if(isset($defaults[$variant->getId()])) {
                        $formElementValue['attributes']['value'] = $defaults[$variant->getId()];
                    }
                    
                    $formElementValue['options'] = array();
                    $formElementValue['options']['label'] = $variant->getName();
                    $formElementValue['options']['label_attributes'] = array(
                            'class'  => 'media-object',
                        );
                    break;
                case 'select':
                    $formElementValue['type'] = 'Zend\Form\Element\Select';
                    $options = array();
                    /*foreach($variant->getProductVariantValues() as $v) {
                        $options[$v->getId()] = $v->getValue();
                    }*/
                    foreach($variant->getProductVariantValues() as $v) {
                        $selected = false;
                        if(isset($defaults[$variant->getName()]) &&  $v->getId() == $defaults[$variant->getName()]) {
                            $selected = true;
                        }
                        $options[] = array(
                            'value' => $v->getId(),
                            'label' => $v->getValue(),
                            'selected' => $selected,
                        );
                    }
                    $formElementValue['attributes'] = array();
                    $formElementValue['attributes']['options'] = $options;
                    $formElementValue['attributes']['class'] = 'form-control form-element';
            
                    $formElementValue['options'] = array();
                    $formElementValue['options']['label'] = $variant->getName();
                    $formElementValue['options']['label_attributes'] = array(
                            'class'  => 'media-object',
                        );
                    break;
                default:
                    $logger = $this
                        ->getServiceLocator()
                        ->get('Logger');
                    $logger->warn(get_class().': Don\'t know what to do with type '.$variant->getType());
                    break;
            }
            
            $this->add($formElementValue);
            $this->variantCounter++;
        }
    }
}