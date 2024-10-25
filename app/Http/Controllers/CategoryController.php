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
        $tracks = $category->tracks()
            ->with(['user', 'week'])
            ->withCount('likes')
            ->orderByDesc('likes_count') 
            ->paginate(20);

        return view('app.categories.show', [
            'category' => $category,
            'tracks' => $tracks
        ]);
    }
}
