<?php

namespace pizzaexpress\Http\Controllers\Api;

use pizzaexpress\Http\Controllers\Controller;
use pizzaexpress\Repositories\CupomRepository;

class CupomController extends Controller
{

    private $repository;

    public function  __construct(CupomRepository $repository)
    {
        $this->repository  = $repository;
    }

    public function show($code)
    {
        return $this->repository->skipPresenter(false)->findByCode($code);
    }

}
