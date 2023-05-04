<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'ensureUserSuscribed'])->only(['show']);
    }

    public function index()
    {
        $articles = Article::paginate(5);

        return Inertia::render('Articles/Index', compact('articles'));
    }

    public function show(Article $article)
    {
        return Inertia::render('Articles/Show', compact('article'));
    }
}
