<?php

namespace AppBundle\Entity;

/**
 * DogPhotosRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DogPhotoRepository extends \Doctrine\ORM\EntityRepository
{

    public function findDogPhotos($id)
    {
        try {
            return $this->getEntityManager()->createQuery(
                'SELECT d FROM AppBundle:DogPhoto d
                WHERE d.dog = :dog
                '
            )
            ->setParameter('dog', $id)
            ->getResult();

        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}