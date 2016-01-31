<?php

namespace pizzaexpress\Http\Controllers;

use Illuminate\Http\Request;

use pizzaexpress\Http\Requests;
use pizzaexpress\Http\Requests\AdminClientRequest;
use pizzaexpress\Repositories\ClientRepository;
use pizzaexpress\Services\ClientService;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $repository;
    private $clientService;

    public function  __construct(ClientRepository $repository, ClientService $clientService)
    {
        $this->repository = $repository;
        $this->clientService = $clientService;
    }

    public function index()
    {
        $clients = $this->repository->paginate();

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminClientRequest $request)
    {
       $data = $request->all();
        $this->clientService->create($data);

        return redirect()->route('index.cliente');
    }

    public function edit($id)
    {
        $client = $this->repository->find($id);

        return view('admin.clients.edit', compact('client'));
    }


    public function update(AdminClientRequest $request, $id)
    {
        $data = $request->all();
        $this->clientService->update($data, $id);

        return redirect()->route('index.cliente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
