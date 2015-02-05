<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-zf2inputfilterannotation) on 2015-02-02
 * 21:38:10.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace ersEntity\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Entity\PaymentType
 *
 * @ORM\Entity()
 * @ORM\Table(name="PaymentType")
 * @ORM\HasLifecycleCallbacks()
 */
class PaymentType implements InputFilterAwareInterface
{
    /**
     * Instance of InputFilterInterface.
     *
     * @var InputFilter
     */
    private $inputFilter;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`name`", type="string", length=45, nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $logo;

    /**
     * @ORM\Column(type="string", length=127, nullable=true)
     */
    protected $shortDescription;

    /**
     * @ORM\Column(type="string", length=1023, nullable=true)
     */
    protected $longDescription;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $fixFee;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $percentageFee;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $activeFrom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $activeUntil;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $days2pay;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\OneToMany(targetEntity="Order", mappedBy="paymentType")
     * @ORM\JoinColumn(name="id", referencedColumnName="PaymentType_id")
     */
    protected $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }
    
    /**
     * @ORM\PrePersist
     */
    public function PrePersist()
    {
        if(!isset($this->created)) {
            $this->created = new \DateTime();
        }
        $this->updated = new \DateTime();
    }
    
    /**
     * Set id of this object to null if it's cloned
     */
    public function __clone() {
        $this->id = null;
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Entity\PaymentType
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Entity\PaymentType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of logo.
     *
     * @param string $logo
     * @return \Entity\PaymentType
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get the value of logo.
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set the value of shortDescription.
     *
     * @param string $shortDescription
     * @return \Entity\PaymentType
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get the value of shortDescription.
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set the value of longDescription.
     *
     * @param string $longDescription
     * @return \Entity\PaymentType
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    /**
     * Get the value of longDescription.
     *
     * @return string
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * Set the value of fixFee.
     *
     * @param float $fixFee
     * @return \Entity\PaymentType
     */
    public function setFixFee($fixFee)
    {
        $this->fixFee = $fixFee;

        return $this;
    }

    /**
     * Get the value of fixFee.
     *
     * @return float
     */
    public function getFixFee()
    {
        return $this->fixFee;
    }

    /**
     * Set the value of percentageFee.
     *
     * @param float $percentageFee
     * @return \Entity\PaymentType
     */
    public function setPercentageFee($percentageFee)
    {
        $this->percentageFee = $percentageFee;

        return $this;
    }

    /**
     * Get the value of percentageFee.
     *
     * @return float
     */
    public function getPercentageFee()
    {
        return $this->percentageFee;
    }

    /**
     * Set the value of activeFrom.
     *
     * @param datetime $activeFrom
     * @return \Entity\PaymentType
     */
    public function setActiveFrom($activeFrom)
    {
        $this->activeFrom = $activeFrom;

        return $this;
    }

    /**
     * Get the value of activeFrom.
     *
     * @return datetime
     */
    public function getActiveFrom()
    {
        return $this->activeFrom;
    }

    /**
     * Set the value of activeUntil.
     *
     * @param datetime $activeUntil
     * @return \Entity\PaymentType
     */
    public function setActiveUntil($activeUntil)
    {
        $this->activeUntil = $activeUntil;

        return $this;
    }

    /**
     * Get the value of activeUntil.
     *
     * @return datetime
     */
    public function getActiveUntil()
    {
        return $this->activeUntil;
    }

    /**
     * Set the value of days2pay.
     *
     * @param integer $days2pay
     * @return \Entity\PaymentType
     */
    public function setDays2pay($days2pay)
    {
        $this->days2pay = $days2pay;

        return $this;
    }

    /**
     * Get the value of days2pay.
     *
     * @return integer
     */
    public function getDays2pay()
    {
        return $this->days2pay;
    }

    /**
     * Set the value of updated.
     *
     * @param datetime $updated
     * @return \Entity\PaymentType
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get the value of updated.
     *
     * @return datetime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set the value of created.
     *
     * @param datetime $created
     * @return \Entity\PaymentType
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get the value of created.
     *
     * @return datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Add Order entity to collection (one to many).
     *
     * @param \Entity\Order $order
     * @return \Entity\PaymentType
     */
    public function addOrder(Order $order)
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * Remove Order entity from collection (one to many).
     *
     * @param \Entity\Order $order
     * @return \Entity\PaymentType
     */
    public function removeOrder(Order $order)
    {
        $this->orders->removeElement($order);

        return $this;
    }

    /**
     * Get Order entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Not used, Only defined to be compatible with InputFilterAwareInterface.
     * 
     * @param \Zend\InputFilter\InputFilterInterface $inputFilter
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used.");
    }

    /**
     * Return a for this entity configured input filter instance.
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if ($this->inputFilter instanceof InputFilterInterface) {
            return $this->inputFilter;
        }
        $factory = new InputFactory();
        $filters = array(
            array(
                'name' => 'id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'name',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'logo',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'shortDescription',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'longDescription',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'fixFee',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'percentageFee',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'activeFrom',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'activeUntil',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'days2pay',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'updated',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'created',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
        );
        $this->inputFilter = $factory->createInputFilter($filters);

        return $this->inputFilter;
    }

    /**
     * Populate entity with the given data.
     * The set* method will be used to set the data.
     *
     * @param array $data
     * @return boolean
     */
    public function populate(array $data = array())
    {
        foreach ($data as $field => $value) {
            $setter = sprintf('set%s', ucfirst(
                str_replace(' ', '', ucwords(str_replace('_', ' ', $field)))
            ));
            if (method_exists($this, $setter)) {
                $this->{$setter}($value);
            }
        }

        return true;
    }

    /**
     * Return a array with all fields and data.
     * Default the relations will be ignored.
     * 
     * @param array $fields
     * @return array
     */
    public function getArrayCopy(array $fields = array())
    {
        $dataFields = array('id', 'name', 'logo', 'shortDescription', 'longDescription', 'fixFee', 'percentageFee', 'activeFrom', 'activeUntil', 'days2pay', 'updated', 'created');
        $relationFields = array();
        $copiedFields = array();
        foreach ($relationFields as $relationField) {
            $map = null;
            if (array_key_exists($relationField, $fields)) {
                $map = $fields[$relationField];
                $fields[] = $relationField;
                unset($fields[$relationField]);
            }
            if (!in_array($relationField, $fields)) {
                continue;
            }
            $getter = sprintf('get%s', ucfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $relationField)))));
            $relationEntity = $this->{$getter}();
            $copiedFields[$relationField] = (!is_null($map))
                ? $relationEntity->getArrayCopy($map)
                : $relationEntity->getArrayCopy();
            $fields = array_diff($fields, array($relationField));
        }
        foreach ($dataFields as $dataField) {
            if (!in_array($dataField, $fields) && !empty($fields)) {
                continue;
            }
            $getter = sprintf('get%s', ucfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $dataField)))));
            $copiedFields[$dataField] = $this->{$getter}();
        }

        return $copiedFields;
    }

    public function __sleep()
    {
        return array('id', 'name', 'logo', 'shortDescription', 'longDescription', 'fixFee', 'percentageFee', 'activeFrom', 'activeUntil', 'days2pay', 'updated', 'created');
    }
}