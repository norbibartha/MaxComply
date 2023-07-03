<?php

namespace App\Repository;

use App\Entity\TechnicalDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TechnicalDetail>
 *
 * @method TechnicalDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method TechnicalDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method TechnicalDetail[]    findAll()
 * @method TechnicalDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TechnicalDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TechnicalDetail::class);
    }

    public function save(TechnicalDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
