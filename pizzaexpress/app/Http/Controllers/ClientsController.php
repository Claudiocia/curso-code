<?php

namespace pizzaexpress\Http\Controllers;

use Illuminate\Http\Request;

use pizzaexpress\Http\Requests;
use pizzaexpress\Http\Requests\AdminClientRequest;
use pizzaexpress\Http\Requests\ClientRequest;
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
    public function inicio()
    {
        return view('index');
    }
    public function info(){
        return view('info');
    }

    public function store(AdminClientRequest $request)
    {
       $data = $request->all();
        $this->clientService->create($data);

        return redirect()->route('index.cliente');
    }

    public function novoCliente(ClientRequest $request)
    {
        $data = $request->all();
        $this->clientService->store($data);
        return redirect()->route('index.home');
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

    public function destroy($id)
    {
        //
    }
}
