<?php

namespace App\Repository;

use App\Entity\Aeropuerto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Aeropuerto>
 *
 * @method Aeropuerto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aeropuerto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aeropuerto[]    findAll()
 * @method Aeropuerto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AeropuertoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aeropuerto::class);
    }

    public function save(Aeropuerto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Aeropuerto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getaeropuertosjson()
    {           
      
        $aeropuertos=$this->findAll();
        $data=[];

        foreach ($aeropuertos as $aeropuerto) {
            $data[] = [
                'id' => $aeropuerto->getId(),
                'nombre' => $aeropuerto->getNombre(),
                'localidad' => $aeropuerto->getLocalidad()
            ];
         }

         return $data;
    }

//    /**
//     * @return Aeropuerto[] Returns an array of Aeropuerto objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Aeropuerto
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
