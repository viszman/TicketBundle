<?php
namespace TicketBundle\Validator\Pesel;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Pesel extends Constraint
{
    public $message = 'Błedna suma kontorlna w numerze PESEL {{string}}';
}
