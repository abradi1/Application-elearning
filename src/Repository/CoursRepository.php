<?php

namespace App\Repository;

use App\Entity\Cours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Classe>
 *
 * @method Cours|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cours|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cours[]    findAll()
 * @method Cours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cours::class);
    }

    public function add(Cours $entity, bool $flush = false): void
    {
        $entityManager=$this->getEntityManager();
        $entityManager->persist($entity);
        $entityManager->flush();
        //$this->getEntityManager()->persist($entity);

        /*if ($flush) {
            $this->getEntityManager()->flush();
        }*/
    }

    public function remove(Cours $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /* Fonction pour récupérer toutes les notes du cours pour en faire la moyenne */
    public function getAllRatingOfTheCourse($id){
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
           
            'SELECT a.user_rating
            FROM App\Entity\Avis a, App\Entity\Cours c
            WHERE c.id = a.cours and a.cours= :id
            '
        )->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    
    }
    


}