<?php

namespace TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use TicketBundle\Validator\Pesel;
use TicketBundle\Validator\Order;

/**
 * TicketOrder
 *
 * @ORM\Table(name="ticket_order")
 * @ORM\Entity(repositoryClass="TicketBundle\Repository\TicketOrderRepository")
 */
class TicketOrder
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Type("alpha",
     *      message="Zła wartość, proszę podać tylko litery"
     *)
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Email
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     * @Pesel\Pesel
     * @Order\Order
     * @ORM\Column(name="pesel", type="string", length=11)
     */
    private $pesel;

    /**
     * @var int
     * @Assert\LessThanOrEqual(
     *     value = 3
     * )
     * @ORM\Column(name="tickets_number", type="integer")
     */
    private $ticketsNumber;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return TicketOrder
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return TicketOrder
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set pesel
     *
     * @param integer $pesel
     *
     * @return TicketOrder
     */
    public function setPesel($pesel)
    {
        $this->pesel = $pesel;

        return $this;
    }

    /**
     * Get pesel
     *
     * @return int
     */
    public function getPesel()
    {
        return $this->pesel;
    }

    /**
     * Set ticketsNumber
     *
     * @param integer $ticketsNumber
     *
     * @return TicketOrder
     */
    public function setTicketsNumber($ticketsNumber)
    {
        $this->ticketsNumber = $ticketsNumber;

        return $this;
    }

    /**
     * Get ticketsNumber
     *
     * @return integer
     */
    public function getTicketsNumber()
    {
        return $this->ticketsNumber;
    }
}
