<?php
namespace App\MathBundle\Controller;

use App\MathBundle\Service\MathServiceInterface;
use App\MathBundle\Service\MathValidationServiceInterface;
use App\MathBundle\Validator\Number;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validation;

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
    public function additionTwo(string $first, string $second, Request $request)
    {
//        $numberConstraint = new Number();
//        $validator = Validation::createValidator();
//
//        $errorList = array_merge(
//            $validator->validate($first, $numberConstraint),
//            $validator->validate($second, $numberConstraint)
//        );

        $errorList = null;
        if ($errorList === null)
            return $this->json([
                'answer' => $this->mathService->AdditionTwo((string)$request->get('first'), (string)$request->get('second'))
            ]);
        else
            return $this->json([
                'error' => 'Input data is not valid'
            ]);
    }

//    /**
//     * @Route("/subtraction", name="subtraction")
//     */
//    public function subtraction(string $first, string $second, Request $request)
//    {
//        if ($this->mathValidationService->ValidateTwoNumber($request))
//            return $this->json([
//                'answer' => $this->mathService->Subtraction((string)$request->get('first'), (string)$request->get('second'))
//            ]);
//        else
//            return $this->json([
//                'error' => 'Input data is not valid'
//            ]);
//    }
//
//    /**
//     * @Route("/multiplication", name="multiplication")
//     */
//    public function multiplication(string $first, string $second, Request $request)
//    {
//        if ($this->mathValidationService->ValidateTwoNumber($request))
//            return $this->json([
//                'answer' => $this->mathService->Multiplication((string)$request->get('first'), (string)$request->get('second'))
//            ]);
//        else
//            return $this->json([
//                'error' => 'Input data is not valid'
//            ]);
//    }
}
