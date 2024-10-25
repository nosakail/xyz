<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index(): View
    {
        return view('app.categories.index', [
            'categories' => Category::withCount('tracks')->get()
        ]);
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category): View
    {
        return view('app.categories.show', [
            'category' => $category,
            'tracks' => $category->tracks()
                ->with(['user', 'week'])
                ->withCount('likes')
                ->latest()
                ->paginate(20)
        ]);
    }
}

