<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;

class CategoriesController extends Controller
{
    //
    public function show(Category $category)
    {
        $topics = Topic::where('category_id', $category->id)->WithOrder(request('order'))->paginate(30);
        return view('topics.index', compact('topics', 'category'));
    }
}
