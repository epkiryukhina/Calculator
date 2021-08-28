<?php
namespace App\MathBundle\Controller;

use App\MathBundle\Service\MathServiceInterface;
use App\MathBundle\Service\MathValidationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MathController extends AbstractController
{
    /** @var MathServiceInterface */
    private $mathService;

    /** @var MathValidationServiceInterface  */
    private $mathValidationService;

    public function __construct(MathServiceInterface $mathService, MathValidationServiceInterface $mathValidationService)
    {
        $this->mathService = $mathService;
        $this->mathValidationService = $mathValidationService;
    }

    /**
     * @Route("/additionTwo", name="additionTwo")
     */
    public function additionTwo(Request $request)
    {
        if ($this->mathValidationService->ValidateTwoNumber($request))
            return $this->json([
                'answer' => $this->mathService->AdditionTwo((string)$request->get('first'), (string)$request->get('second'))
            ]);
        else
            return $this->json([
                'error' => 'Input data is not valid'
            ]);
    }

    /**
     * @Route("/additionThree", name="additionThree")
     */
    public function additionThree(Request $request)
    {
        if ($this->mathValidationService->ValidateThreeNumber($request))
            return $this->json([
                'answer' => $this->mathService->AdditionThree((string)$request->get('first'), (string)$request->get('second'), (string)$request->get('third'))
            ]);
        else
            return $this->json([
                'error' => 'Input data is not valid'
            ]);
    }

    /**
     * @Route("/subtraction", name="subtraction")
     */
    public function subtraction(Request $request)
    {
        if ($this->mathValidationService->ValidateTwoNumber($request))
            return $this->json([
                'answer' => $this->mathService->Subtraction((string)$request->get('first'), (string)$request->get('second'))
            ]);
        else
            return $this->json([
                'error' => 'Input data is not valid'
            ]);
    }

    /**
     * @Route("/multiplication", name="multiplication")
     */
    public function multiplication(Request $request)
    {
        if ($this->mathValidationService->ValidateTwoNumber($request))
            return $this->json([
                'answer' => $this->mathService->Multiplication((string)$request->get('first'), (string)$request->get('second'))
            ]);
        else
            return $this->json([
                'error' => 'Input data is not valid'
            ]);
    }
}
