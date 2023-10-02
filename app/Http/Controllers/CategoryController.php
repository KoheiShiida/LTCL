<?php
use App\Models\Category;

class CategoryController extends PostController
{
    public function index(Category $category)
        {
            return view('categories.index')->with(['posts' => $category->getByCategory()]);
        }
}