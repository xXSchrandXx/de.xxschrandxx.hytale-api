<?php

namespace wcf\event\hytale;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use wcf\data\hytale\Hytale;

class GetHytaleEvent extends ValidateHeaderEvent
{
    private Hytale $hytale;

    public function __construct(ServerRequestInterface $request, Hytale $hytale, ?JsonResponse $response = null)
    {
        parent::__construct($request, $response);
        $this->hytale = $hytale;
    }

    public function getHytale(): Hytale
    {
        return $this->hytale;
    }
}
