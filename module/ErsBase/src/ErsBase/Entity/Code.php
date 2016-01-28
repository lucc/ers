<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-realentity) on 2016-01-07 08:26:28.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace ErsBase\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ErsBase\Entity\Code
 *
 * @ORM\Entity()
 * @ORM\Table(name="code")
 * @ORM\HasLifecycleCallbacks
 */
class Code extends Base\Code
{
    protected $length = 6;
    
    public function __construct()
    {
        parent::__construct();
    }

    public function genCode() {
        /*
         * Alphabet for codes:
         * 0 <- O Q
         * 1 <- I J L
         * 2 <- Z
         * 3 <- E
         * 4
         * 5 <- S
         * 6 <- G
         * 7 <- T
         * 8 <- B
         * 9
         * A
         * C
         * D
         * F
         * H
         * K
         * M
         * N
         * P
         * R
         * U
         * V
         * W
         * X
         * Y
         */
        $alphabet = "0123456789ACDFHKMNPRUVWXY";
        $memory = '';
        $n = '';
        #srand(time());
        srand(rand()*time());
        for ($i = 0; $i < $this->length; $i++) {
            
            while($n == '' || $memory == $alphabet[$n]) {
                $n = rand(0, strlen($alphabet)-1);
            }
            $memory = $alphabet[$n];
            $code[$i] = $alphabet[$n];
        }
        
        $this->setValue(implode($code).$this->genChecksum(implode($code)));
        
        return $this;
    }
    private function genChecksum($code) {
        $chars = str_split($code);
        $nums = array();
        foreach($chars as $char) {
            $nums[] = ord($char);
        }
        $cross_sum = array_sum($nums);
        $checksum = $cross_sum % 100;
        return sprintf('%02d', $checksum);
    }
    
    /**
     * Check if code checksum is valid
     * 
     * @return boolean
     */
    public function checkCode() {
        $checksum = substr($this->getValue(),$this->length);
        $code = substr($this->getValue(),0,$this->length);
        if($this->genChecksum($code) == $checksum) {
            return true;
        } else {
            return false;
        }
    }

    private function normalizeText($text) {
        $text = strtoupper($text);
        $matrix = array(
            '0' => array(
                'O',
                'Q',
            ),
            '1' => array(
                'I',
                'J',
                'L',
            ),
            '2' => array(
                'Z',
            ),
            '3' => array(
                'E',
            ),
            '5' => array(
                'S',
            ),
            '6' => array(
                'G',
            ),
            '7' => array(
                'T',
            ),
            '8' => array(
                'B',
            ),
        );
        $pattern = array();
        $replace = array();
        foreach($matrix as $key => $values) {
            foreach($values as $value) {
                $pattern[] = '/'.$value.'/';
                $replace[] = $key;
            }
        }
        return preg_replace($pattern, $replace, $text);
    }
    
    /**
     * normalize value of this code
     * 
     * @return \ErsBase\Entity\Code
     */
    public function normalize() {
        $this->setValue($this->normalizeText($this->getValue()));
        
        return $this;
    }
}
