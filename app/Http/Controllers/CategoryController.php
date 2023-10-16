<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategory;
use App\Models\Categories;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Categories::orderBy('created_at', 'desc')->paginate(5);

        return view('dashboard.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreCategory $request)
    {
        //
        try {


            $categoryData = $request->input();
            $category = [
                'name' => $categoryData['name'],
                'description' => $categoryData['description']
            ];
            var_dump($category);
            Categories::create($category);
            return back()->with('category  ', $category);
        }catch (\Exception $e){
            return $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $category)
    {
        //
              return view('dashboard.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $category)
    {
        //
        $data = $request->input();
        $category = [
            'name'=>$data['name'],
            'description'=>$data['description']
        ];
        Categories::where('id', $data['id'])->update( $category);
        return back()->with('status',"Post modificado exitosamente");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $data =$request->input();
        Categories::where('id', $data['id'])->delete();
        return back()->with('status', 'Post eliminado exitosamente');
    }
}
