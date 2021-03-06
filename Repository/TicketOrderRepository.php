<?php

namespace TicketBundle\Repository;

use TicketBundle\Entity\TicketOrder;
/**
 * TicketOrderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TicketOrderRepository extends \Doctrine\ORM\EntityRepository
{
    public function canAddTickets(int $availableTickets, int $ticket)
    {
        $results = $this->getSum();
        $good = true;

        if ($results['ticketsNumber'] + $ticket > $availableTickets) {
            $good = false;
        }

        return $good;
    }

    public function canAddUser($pesel, $ticketNumber)
    {
        $result = $this->getSum($pesel);
        if ($result['ticketsNumber'] + (int)$ticketNumber > 3) {
            return false;
        }
        return true;
    }

    private function getSum($pesel = null)
    {
        $em = $this->getEntityManager();
        $builder = $em->createQueryBuilder();
        $builder
            ->select('SUM(t.ticketsNumber) as ticketsNumber')
            ->from('TicketBundle\Entity\TicketOrder', 't');

        if ($pesel) {
            $builder->where('t.pesel = :pesel')
            ->setParameter('pesel', $pesel);
        }

        $query = $builder->getQuery();
        $results = $query->getOneOrNullResult();
        return $results;
    }

    public function getAllUserInfo()
    {
        $em = $this->getEntityManager();
        $builder = $em->createQueryBuilder();
        $builder
            ->select('t.name, t.email, t.pesel, sum(t.ticketsNumber) as number')
            ->from('TicketBundle\Entity\TicketOrder', 't')
            ->groupBy('t.pesel');

        $query = $builder->getQuery();
        $results = $query->getResult();
        return $results;
    }
}
