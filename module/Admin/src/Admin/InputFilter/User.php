<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\InputFilter;

use Zend\InputFilter\Factory as InputFactory; 
use Zend\InputFilter\InputFilter; 
use Zend\InputFilter\InputFilterAwareInterface; 
use Zend\InputFilter\InputFilterInterface; 
use Zend\Session\Container;

class User implements InputFilterAwareInterface 
{ 
    protected $inputFilter; 
    protected $em;
    protected $sm;
    
    public function setEntityManager(\Doctrine\ORM\EntityManager $em) {
        $this->em = $em;
    }
    public function getEntityManager() {
        return $this->em;
    }
    
    public function setServiceLocator($sm) {
        $this->sm = $sm;
    }
    public function getServiceLocator() {
        return $this->sm;
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter) 
    { 
        throw new \Exception("Not used"); 
    } 
    
      public function getInputFilter()
    {
        if (!$this->inputFilter) 
        { 
            $inputFilter = new InputFilter(); 
            $factory = new InputFactory();             

            $inputFilter->add($factory->createInput([ 
                'name' => 'firstname', 
                'required' => true, 
                'filters' => array( 
                    array('name' => 'StripTags'), 
                    array('name' => 'StringTrim'), 
                ), 
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 45,
                        ),
                    ),
                    array ( 
                        'name' => 'Callback', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\Callback::INVALID_VALUE => 'The provided name contains invalid character. These charaters are not allowed: !"§$%()=<>|^;{}[]',
                            ),
                            'callback' => function($value, $context=array()) {
                                $alphabet = '!"§$%()=<>|^;{}[]';
                                $alpha = str_split($alphabet);
                                foreach($alpha as $char) {
                                    if(strstr($value, $char)) {
                                        return false;
                                    }
                                }
                                return true;
                            },
                            
                        ),
                    ),
                ), 
            ])); 

            $inputFilter->add($factory->createInput([ 
                'name' => 'surname', 
                'required' => true, 
                'filters' => array( 
                    array('name' => 'StripTags'), 
                    array('name' => 'StringTrim'), 
                ), 
                'validators' => array( 
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 45,
                        ),
                    ),
                    array ( 
                        'name' => 'Callback', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\Callback::INVALID_VALUE => 'The provided name contains invalid character. These charaters are not allowed: !"§$%()=<>|^;{}[]',
                            ),
                            'callback' => function($value, $context=array()) {
                                $alphabet = '!"§$%()=<>|^;{}[]';
                                $alpha = str_split($alphabet);
                                foreach($alpha as $char) {
                                    if(strstr($value, $char)) {
                                        return false;
                                    }
                                }
                                return true;
                            },
                            
                        ),
                    ),
                ), 
            ])); 
            
            $inputFilter->add($factory->createInput([ 
                'name' => 'birthday', 
                'required' => false,
                'filters' => array( 
                    array('name' => 'StripTags'), 
                    array('name' => 'StringTrim'), 
                ), 
                'validators' => array( 
                    array(
                        'name' => 'Date',
                        'options' => array(
                            'format' => 'd.m.Y',
                        ),
                    ),
                    array(
                        'name' => 'Callback', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\Callback::INVALID_VALUE => 'Please choose a valid birthday',
                            ),
                            'callback' => function($value, $context=array()) {
                                $min = \DateTime::createFromFormat('d.m.Y', '01.01.1900');
                                $max = new \DateTime();
                                $birthday = \DateTime::createFromFormat('d.m.Y', $value);
                                if(!$birthday instanceof \DateTime) {
                                    return false;
                                }
                                if($min->getTimestamp() > $birthday->getTimestamp()) {
                                    return false;
                                }
                                if($max->getTimestamp() < $birthday->getTimestamp()) {
                                    return false;
                                }
                                return true;
                            },
                        ),
                    ),
                ),
            ])); 

            $inputFilter->add($factory->createInput([ 
                'name' => 'email', 
                'required' => false, 
                'filters' => array( 
                    array('name' => 'StripTags'), 
                    array('name' => 'StringTrim'), 
                ), 
                'validators' => array( 
                    array ( 
                        'name' => 'EmailAddress', 
                        'options' => array( 
                            'messages' => array( 
                                'emailAddressInvalidFormat' => 'Email address format is not invalid', 
                            ) 
                        ), 
                    ),
                    array ( 
                        'name' => 'Callback', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\Callback::INVALID_VALUE => 'There is already a person with this email address in the system.',
                            ),
                            'callback' => function($value, $context=array()) {
                                /*if(
                                    isset($context['session_id']) && 
                                    is_numeric($context['session_id']) && 
                                    $context['session_id'] != 0
                                ) {
                                    return true;
                                }*/
                                $em = $this->getServiceLocator()
                                    ->get('Doctrine\ORM\EntityManager');
                                $user = $em->getRepository('ErsBase\Entity\User')
                                        ->findOneBy(array('email' => $value));
                                if($user && $user->getId() != $context['id']) {
                                    return false;
                                }
                                return true;
                            },
                        ),
                    ),
                ), 
            ])); 
 
            $this->inputFilter = $inputFilter; 
        } 
        
        return $this->inputFilter; 
    }
} 