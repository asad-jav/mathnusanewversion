<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::allCategories();
        return view('category.index', $data);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $req)
    {
        $category = new Category();
        $category->selectCols($req);
        
        if($category->save()) {
            return back()->with('success', __('messages.Category added successfully'));
        } else {
            return back()->with('failure', __('messages.Data not inserted into the database'));
        }
    }

    public function edit($id)
    {
        $data['category'] = Category::find($id);
        return view('category.edit', $data);
    }

    public function update(Request $req)
    {
        $category = Category::find($req->id);
        $category->selectCols($req);

        if($category->update()) {
            return back()->with('success', __('messages.Category updated successfully'));
        } else {
            return back()->with('failure', __('messages.Data not updated into the database'));
        }
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if($category->delete()) {
            return back()->with('success', __('messages.Category deleted successfully'));
        }
    }

    public function categoryCourses($id)
    {
        $data['courses'] = Category::find($id)->courses;
        return view('course.index', $data);
    }
}
