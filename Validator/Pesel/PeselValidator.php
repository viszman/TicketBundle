<?php
namespace TicketBundle\Validator\Pesel;

use TicketBundle\Validator\Pesel\Pesel;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PeselValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$this->checkNumbers($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{string}}', $value)
                ->addViolation();
        }
    }

    private function checkNumbers($pesel){
        $pesel = str_split($pesel);
        $checker = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $sum = 0;

        foreach ($checker as $key => $number) {
            $sum += $pesel[$key] *$number;
        }
        if ( 10 -(int)substr($sum, -1, 1) !== (int)$pesel[count($pesel)-1]) {
            return false;
        }
        return true;
    }
}
