<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article\Article;
use App\Repositories\Article\ArticleRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleRepository;

    protected $viewPrefix = 'article.';
    protected $routePrefix = 'article.';

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
        $paginate = $this->articleRepository->getPaginatePublish(20);

        return view($this->viewPrefix . 'list')
            ->with('paginate', $paginate);
    }

    /**
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Article $article)
    {
        if (false == $article->isPublish()) {
            abort(404);
        }

        return view($this->viewPrefix . 'detail')
            ->with('article', $article);
    }

}
