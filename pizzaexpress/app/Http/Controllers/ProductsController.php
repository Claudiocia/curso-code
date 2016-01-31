<?php

namespace pizzaexpress\Http\Controllers;

use Illuminate\Http\Request;

use pizzaexpress\Http\Requests;
use pizzaexpress\Http\Requests\AdminProductRequest;
use pizzaexpress\Repositories\CategoryRepository;
use pizzaexpress\Repositories\ProductRepository;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $repository;

    public function  __construct(ProductRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $products = $this->repository->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->lists();
        return view('admin.products.create',compact('categories') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminProductRequest $request)
    {
       $data = $request->all();
        $this->repository->create($data);

        return redirect()->route('index.produto');
    }

    public function edit($id)
    {
        $product = $this->repository->find($id);
        $categories = $this->categoryRepository->lists();

        return view('admin.products.edit', compact('product', 'categories'));
    }


    public function update(AdminProductRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('index.produto');
    }


    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('index.produto');
    }
}
