<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleSaveRequest;
use App\Models\Article\Article;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\CategoryRepository;
use App\Services\Article\ArticleService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{

    // protected $viewPrefix = 'admin.index.';
    protected $routePrefix = 'admin.index.';

    public function __construct()
    {
    }

    public function index()
    {
        return Inertia::render('Admin/Index');
    }

}
