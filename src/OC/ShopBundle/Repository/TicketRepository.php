<?php

namespace OC\ShopBundle\Repository\TicketRepository;

/**
 * TicketRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TicketRepository extends \Doctrine\ORM\EntityRepository
{
    public function getNbTicketsPerDay()
    {
        $startDay = \DateTime::createFromFormat( "Y-m-d H:i:s", date("Y-m-d 00:00:00") );
        $endDay = \DateTime::createFromFormat( "Y-m-d H:i:s", date("Y-m-d 23:59:59") );
        $qb = $this
            ->createQueryBuilder('t')
            ->select('COUNT(t)')
            ->leftJoin('t.order', 'o')
            ->where('o.datedevisite >= :start_day')
            ->andWhere('o.datedevisite <= :end_day')
            ->setParameter('start_day', $startDay)
            ->setParameter('end_day', $endDay)
        ;
        return $qb->getQuery()->getSingleScalarResult();
    }
}
