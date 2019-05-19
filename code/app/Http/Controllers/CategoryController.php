<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Middleware
    public function __construct()
    {
        // only Admins have access
        $this->middleware('admin');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category_create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $rules = $rules = array(
            'name' => 'required|min:3|max:191|unique:categories',
        );
        
        $this->validate($request, $rules);
        
        $category = new Category();
        $category->name = $data['name'];
        $category->save();
        return redirect('admin')->with('message','Category added!');
    }

}
