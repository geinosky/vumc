<?php
namespace App\Controller;

use App\Entity\Phecode;
use App\Repository\PhecodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PhecodeController extends ApiController
{
  /**
   * @Route("/phecode", methods="GET")
   */
  public function index(PhecodeRepository $phecodeRepository)
  {
    $codes = $phecodeRepository->transformAll();

    return $this->respond($codes);
  }
}