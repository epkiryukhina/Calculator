<?php
namespace App\MathBundle\Controller;

use App\MathBundle\Service\MathServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MathController extends AbstractController
{
    /** @var MathServiceInterface */
    private $mathService;

    public function __construct(MathServiceInterface $mathLogger)
    {
        $this->mathService = $mathLogger;
    }

    /**
     * @Route("/addition/{first}/{second}", name="additionTwo")
     */
    public function addition(string $first, string $second)
    {
        $responseMessage = $this->mathService->addition($first, $second);
        return $this->json($responseMessage);
    }

    /**
     * @Route("/subtraction/{first}/{second}", name="subtraction")
     */
    public function subtraction(string $first, string $second)
    {
        $responseMessage = $this->mathService->subtraction($first, $second);
        return $this->json($responseMessage);
    }

    /**
     * @Route("/multiplication/{first}/{second}", name="multiplication")
     */
    public function multiplication(string $first, string $second)
    {
        $responseMessage = $this->mathService->multiplication($first, $second);
        return $this->json($responseMessage);
    }
}
