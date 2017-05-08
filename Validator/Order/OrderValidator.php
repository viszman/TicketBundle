<?php
namespace TicketBundle\Validator\Order;

use TicketBundle\Validator\Order\Order;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class OrderValidator extends ConstraintValidator
{
    /**
    * @var EntityManager
    */
    private $em;

    public function __construct(EntityManager $entityManager)
   {
      $this->em = $entityManager;
   }

    public function validate($value, Constraint $constraint)
    {
        $canAdd = $this->em->getRepository('TicketBundle:TicketOrder')->canAddUser($value);
        if (!$canAdd) {
            $this->context->buildViolation($constraint->message)
              ->addViolation();
        }
    }
}
