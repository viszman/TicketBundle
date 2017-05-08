<?php
namespace TicketBundle\Validator\Order;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Order extends Constraint
{
    public $message = 'wykupiłes maksymalną liczbę biletow';

    public function validatedBy()
  {
      return 'ticket.order.validator';
  }
}
