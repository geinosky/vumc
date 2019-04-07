<?php
namespace App\Controller;

use App\Entity\Icd9;
use App\Repository\Icd9Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class Icd9Controller extends ApiController
{
  /**
   * @Route("/icd9", methods="GET")
   */
  public function index(Icd9Repository $icd9Repository)
  {
    $codes = $icd9Repository->transformAll();

    return $this->respond($codes);
  }
}