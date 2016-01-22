<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-mappedsuperclass) on 2016-01-22 16:15:23.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace ErsBase\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * ErsBase\Entity\Base\Match
 *
 * @ORM\MappedSuperclass
 * @ORM\Table(name="`match`", indexes={@ORM\Index(name="fk_Matching_User1_idx", columns={"admin_id"}), @ORM\Index(name="fk_match_bank_statement1_idx", columns={"bank_statement_id"}), @ORM\Index(name="fk_match_order1_idx", columns={"order_id"})})
 * @ORM\HasLifecycleCallbacks
 */
class Match
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $bank_statement_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $order_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $admin_id;

    /**
     * @ORM\Column(name="`comment`", type="text", nullable=true)
     */
    protected $comment;

    /**
     * @ORM\Column(name="`status`", type="string", length=45, nullable=true)
     */
    protected $status;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\ManyToOne(targetEntity="BankStatement", inversedBy="matches")
     * @ORM\JoinColumn(name="bank_statement_id", referencedColumnName="id")
     */
    protected $bankStatement;

    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="matches")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    protected $order;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="matches")
     * @ORM\JoinColumn(name="admin_id", referencedColumnName="id")
     */
    protected $user;

    public function __construct()
    {
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
     * @ORM\PreUpdate
     */
    public function PreUpdate()
    {
        $this->updated = new \DateTime();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \ErsBase\Entity\Base\Match
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
     * Set the value of bank_statement_id.
     *
     * @param integer $bank_statement_id
     * @return \ErsBase\Entity\Base\Match
     */
    public function setBankStatementId($bank_statement_id)
    {
        $this->bank_statement_id = $bank_statement_id;

        return $this;
    }

    /**
     * Get the value of bank_statement_id.
     *
     * @return integer
     */
    public function getBankStatementId()
    {
        return $this->bank_statement_id;
    }

    /**
     * Set the value of order_id.
     *
     * @param integer $order_id
     * @return \ErsBase\Entity\Base\Match
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;

        return $this;
    }

    /**
     * Get the value of order_id.
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Set the value of admin_id.
     *
     * @param integer $admin_id
     * @return \ErsBase\Entity\Base\Match
     */
    public function setAdminId($admin_id)
    {
        $this->admin_id = $admin_id;

        return $this;
    }

    /**
     * Get the value of admin_id.
     *
     * @return integer
     */
    public function getAdminId()
    {
        return $this->admin_id;
    }

    /**
     * Set the value of comment.
     *
     * @param string $comment
     * @return \ErsBase\Entity\Base\Match
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of status.
     *
     * @param string $status
     * @return \ErsBase\Entity\Base\Match
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of updated.
     *
     * @param \DateTime $updated
     * @return \ErsBase\Entity\Base\Match
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get the value of updated.
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set the value of created.
     *
     * @param \DateTime $created
     * @return \ErsBase\Entity\Base\Match
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get the value of created.
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set BankStatement entity (many to one).
     *
     * @param \ErsBase\Entity\Base\BankStatement $bankStatement
     * @return \ErsBase\Entity\Base\Match
     */
    public function setBankStatement(BankStatement $bankStatement = null)
    {
        $this->bankStatement = $bankStatement;

        return $this;
    }

    /**
     * Get BankStatement entity (many to one).
     *
     * @return \ErsBase\Entity\Base\BankStatement
     */
    public function getBankStatement()
    {
        return $this->bankStatement;
    }

    /**
     * Set Order entity (many to one).
     *
     * @param \ErsBase\Entity\Base\Order $order
     * @return \ErsBase\Entity\Base\Match
     */
    public function setOrder(Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get Order entity (many to one).
     *
     * @return \ErsBase\Entity\Base\Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set User entity (many to one).
     *
     * @param \ErsBase\Entity\Base\User $user
     * @return \ErsBase\Entity\Base\Match
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get User entity (many to one).
     *
     * @return \ErsBase\Entity\Base\User
     */
    public function getUser()
    {
        return $this->user;
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
        $dataFields = array('id', 'bank_statement_id', 'order_id', 'admin_id', 'comment', 'status', 'updated', 'created');
        $relationFields = array('user', 'bankStatement', 'order');
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
        return array('id', 'bank_statement_id', 'order_id', 'admin_id', 'comment', 'status', 'updated', 'created');
    }
}