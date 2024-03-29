<?php
namespace App\Controller;

use App\Entity\Icd9;
use App\Repository\Icd9Repository;
use App\Repository\MapRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class Icd9Controller extends ApiController
{
  /**
   * @Route("/icd9", methods="GET")
   */
  public function index(Request $request, Icd9Repository $icd9Repository)
  {
    $phecode = $request->query->get('phecode');
    $icd9Query = $icd9Repository->findByPhecode($phecode);

    return $this->respond($icd9Query);
  }
}