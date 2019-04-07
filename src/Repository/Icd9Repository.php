<?php

namespace App\Repository;

use App\Entity\Icd9;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Icd9|null find($id, $lockMode = null, $lockVersion = null)
 * @method Icd9|null findOneBy(array $criteria, array $orderBy = null)
 * @method Icd9[]    findAll()
 * @method Icd9[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Icd9Repository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Icd9::class);
    }

  public function transform(Icd9 $code)
  {
    return [
      'id'    => (int) $code->getId(),
      'icd9Code' => (string) $code->getCode(),
      'description' => (string) $code->getDescription()
    ];
  }

  public function transformAll()
  {
    $icd9Codes = $this->findAll();
    $icd9CodesArray = [];

    foreach ($icd9Codes as $code) {
      $icd9CodesArray[] = $this->transform($code);
    }

    return $icd9CodesArray;
  }
}
