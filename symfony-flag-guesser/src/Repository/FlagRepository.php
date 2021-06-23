<?php

namespace App\Repository;

use App\Entity\Flag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Flag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flag[]    findAll()
 * @method Flag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flag::class);
    }

    /**
     * @return Flag[]
     */
    public function findAllFlagsInContinent(string $cont): array
    {
        $entityManager = $this->getEntityManager();

        $list = explode('-', $cont);
        $where = ' WHERE ';
        foreach($list as $continent) {
            $where .= "f.category='$continent' OR ";
        }
        $where .= '1=0 ';
        
        print('SELECT f
        FROM App\Entity\Flag f' .
        $where . 
        'ORDER BY f.id ASC');

        $query = $entityManager->createQuery(
            'SELECT f
            FROM App\Entity\Flag f' .
            $where . 
            'ORDER BY f.id ASC');

        // returns an array of Flags objects
        return $query->getResult();
        // return $this->findAll();
    }
    // /**
    //  * @return Flag[] Returns an array of Flag objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Flag
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
