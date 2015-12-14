<?php

namespace AppBundle\Entity;

/**
 * ResponsesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ResponseRepository extends \Doctrine\ORM\EntityRepository
{
    public function findOwnerResponses($id)
    {
        try {
            return $this->getEntityManager()->createQuery(
                'SELECT re, wr, r, o FROM AppBundle:Response re
                LEFT JOIN re.watcherRequest wr
                LEFT JOIN wr.request r
                LEFT JOIN r.owner o
                WHERE o.id = :owner
                '
            )
            ->setParameter('owner', $id)
            ->getResult();

        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findOwnerResponse($owner, $response)
    {
        try {
            return $this->getEntityManager()->createQuery(
                'SELECT re,wr,r,re,o FROM AppBundle:Response re
                LEFT JOIN re.watcherRequest wr
                LEFT JOIN wr.request r
                LEFT JOIN r.owner o
                WHERE re.id = :response
                AND o.id = :owner
                '
            )
            ->setParameter('response', $response)
            ->setParameter('owner', $owner)
            ->getSingleResult();

        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findOwnerHiredResponse($owner)
    {
        try {
            return $this->getEntityManager()->createQuery(
                'SELECT re FROM AppBundle:Response re
                LEFT JOIN re.watcherRequest wr
                LEFT JOIN wr.request r
                LEFT JOIN r.owner o
                WHERE o.id = :owner
                AND re.accepted = 1
                '
            )
            ->setParameter('owner', $owner)
            ->getSingleResult();

        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}