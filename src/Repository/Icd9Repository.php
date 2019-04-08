<?php

namespace App\Repository;

use App\Entity\Icd9;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Icd9|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Icd9|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Icd9[]    findAll()
 * @method Icd9[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class Icd9Repository extends ServiceEntityRepository {
  public function __construct(RegistryInterface $registry) {
    parent::__construct($registry, Icd9::class);
  }

  public function transform(Icd9 $code) {
    return [
      'id' => (int) $code->getId(),
      'code' => (string) $code->getCode(),
      'description' => (string) $code->getDescription()
    ];
  }

  public function transformAll() {
    $icd9Codes = $this->findAll();
    $icd9CodesArray = [];

    foreach ($icd9Codes as $code) {
      $icd9CodesArray[] = $this->transform($code);
    }

    return $icd9CodesArray;
  }

  /**
   * @return Icd9[] Returns an array of icd9 objects
   */
  public function findByPhecode($phecode)
  {

    $conn = $this->getEntityManager()
      ->getConnection();
    $sql = 'SELECT DISTINCT i.code, i.description
      FROM icd9 i
	    LEFT JOIN phecode_map map ON i.code = map.icd9
	    LEFT JOIN phecode p ON map.phecode = p.code
	    WHERE p.description = :code
	    ORDER BY i.code';
    $stmt = $conn->prepare($sql);
    $stmt->execute(array('code' => $phecode));
    $users = $stmt->fetchAll();

    return $users;
  }
}