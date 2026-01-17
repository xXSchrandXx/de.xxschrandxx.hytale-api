<?php

namespace wcf\event\hytale;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use wcf\data\hytale\Hytale;

class ReadParametersEvent extends GetHytaleEvent
{
    private array $parameters;

    public function __construct(ServerRequestInterface $request, Hytale $hytale, array $parameters, ?JsonResponse $response = null)
    {
        parent::__construct($request, $hytale, $response);
        $this->parameters = $parameters;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getParameter(mixed $key): mixed
    {
        return $this->parameters[$key];
    }

    public function setParameter(mixed $key, mixed $value)
    {
        $this->parameters[$key] = $value;
    }
}
