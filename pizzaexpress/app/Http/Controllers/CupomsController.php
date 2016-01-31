<?php

namespace pizzaexpress\Http\Controllers;

use Illuminate\Http\Request;

use pizzaexpress\Http\Requests;
use pizzaexpress\Http\Requests\AdminCategoryRequest;
use pizzaexpress\Http\Requests\AdminCupomRequest;
use pizzaexpress\Repositories\CategoryRepository;
use pizzaexpress\Repositories\CupomRepository;

class CupomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $repository;

    public function  __construct(CupomRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $cupoms = $this->repository->paginate(10);

        return view('admin.cupoms.index', compact('cupoms'));
    }

    public function create()
    {
        return view('admin.cupoms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCupomRequest $request)
    {
       $data = $request->all();
        $this->repository->create($data);

        return redirect()->route('index.cupom');
    }

    public function edit($id)
    {
        $list_used = [0=>'Livre', 1=>'Atribuido', 2=>'Usado', 3=>'Cancelado'];
        $cupom = $this->repository->find($id);

        return view('admin.cupoms.edit', compact('cupom', 'list_used'));
    }

    public function update(AdminCupomRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('index.cupom');
    }

    public function destroy($id)
    {
        //
    }
}
