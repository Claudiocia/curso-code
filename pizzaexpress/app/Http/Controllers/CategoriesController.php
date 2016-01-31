<?php

namespace pizzaexpress\Http\Controllers;

use Illuminate\Http\Request;

use pizzaexpress\Http\Requests;
use pizzaexpress\Http\Requests\AdminCategoryRequest;
use pizzaexpress\Repositories\CategoryRepository;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $repository;

    public function  __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $categories = $this->repository->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCategoryRequest $request)
    {
       $data = $request->all();
        $this->repository->create($data);

        return redirect()->route('index.categoria');
    }

    public function edit($id)
    {
        $category = $this->repository->find($id);

        return view('admin.categories.edit', compact('category'));
    }


    public function update(AdminCategoryRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('index.categoria');
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
