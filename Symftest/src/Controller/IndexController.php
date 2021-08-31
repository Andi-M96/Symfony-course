<?php 

namespace App\Controller;

use App\Entity\Hotel;
use App\Service\DateCalculator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController  extends AbstractController{

    private const HOTEL_OPENED = 1969;
/**
* @Route("/")
 */
public function home(LoggerInterface $logger, DateCalculator $dateCalculator) {

    $logger->info('Hompage loaded.');

    $year = $dateCalculator->yearsDifference(self::HOTEL_OPENED);

    $hotels = $this->getDoctrine()->getRepository(Hotel::class)
    ->findAllBelowPrice(750);

    return $this->render('index.html.twig', [ 'year'=> $year, 'hotels' => $hotels ]);
 
}
}