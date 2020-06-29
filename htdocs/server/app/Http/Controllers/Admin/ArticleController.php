<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article\Article;
use App\Repositories\Article\ArticleRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleRepository;

    protected $viewPrefix = 'admin.article.';
    protected $routePrefix = 'admin.article.';

    public function __construct(
        ArticleRepository $articleRepository
    )
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function list(Request $request)
    {
        $paginate = $this->articleRepository->getPaginate(20);

        return view($this->viewPrefix . 'list')
            ->with('paginate', $paginate);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->viewPrefix . 'form');
    }

}
