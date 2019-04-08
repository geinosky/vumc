<?php

namespace App\Repository;

use App\Entity\Phecode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Phecode|null find($id, $lockMode = null, $lockVersion = null)
 * @method Phecode|null findOneBy(array $criteria, array $orderBy = null)
 * @method Phecode[]    findAll()
 * @method Phecode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhecodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Phecode::class);
    }

  public function transform(Phecode $code)
  {
    return [
      'id'    => (int) $code->getId(),
      'phecode' => (string) $code->getCode(),
      'description' => (string) $code->getDescription()
    ];
  }

  public function transformAll()
  {
    $phecodes = $this->findAll();
    $phecodesArray = [];

    foreach ($phecodes as $code) {
      $phecodesArray[] = $this->transform($code);
    }

    return $phecodesArray;
  }
}
