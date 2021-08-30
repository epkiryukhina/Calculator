<?php
namespace App\MathBundle\Service;

use Psr\Log\LoggerInterface;

class MathServiceLoggerDecorator implements MathServiceInterface
{
    /** @var MathServiceInterface */
    private $mathService;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        MathServiceInterface $mathValidator,
        LoggerInterface $logger
    ) {
        $this->mathService = $mathValidator;
        $this->logger = $logger;
    }

    /**
     * @param string $first
     * @param string $second
     */
    public function addition(string $first, string $second)
    {
        try {
            return ['answer' => $this->mathService->addition($first, $second)];
        }
        catch (\Exception $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * @param string $first
     * @param string $second
     */
    public function subtraction(string $first, string $second)
    {
        try {
            return ['answer' => $this->mathService->subtraction($first, $second)];
        }
        catch (\Exception $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * @param string $first
     * @param string $second
     */
    public function multiplication(string $first, string $second)
    {
        try {
            return ['answer' => $this->mathService->multiplication($first, $second)];
        }
        catch (\Exception $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());
            return ['error' => $e->getMessage()];
        }
    }
}