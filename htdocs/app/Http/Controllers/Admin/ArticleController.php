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

class ArticleController extends Controller
{
    protected $articleService;
    protected $articleRepository;
    protected $categoryRepository;

    protected $viewPrefix = 'admin.article.';
    protected $routePrefix = 'admin.article.';

    public function __construct(
        ArticleService $articleService,
        ArticleRepository $articleRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->articleService = $articleService;
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function list(Request $request)
    {
        $paginate = $this->articleRepository->getPaginateAdmin();

        return view($this->viewPrefix . 'list')
            ->with('paginate', $paginate);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Inertia\Response
     */
    public function create(Request $request)
    {
        $categories = $this->categoryRepository->all();

        return Inertia::render('Admin/Article/Form', [
            'actionUrl' => route($this->routePrefix . 'store'),
            'categories' => $categories
        ]);
    }

    public function store(ArticleSaveRequest $request)
    {
        $article = $this->articleService->create($request->all());

        session()->flash('status', '記事を保存しました。');

        return redirect()->route($this->routePrefix . 'edit', ['article' => $article]);
    }


    public function edit(Article $article, Request $request)
    {
        $categories = $this->categoryRepository->all();

        return Inertia::render('Admin/Article/Form', [
            'actionUrl' => route($this->routePrefix . 'store'),
            'categories' => $categories,
            'values' => $article->toArray()
        ]);
    }

    public function update(Article $article, Request $request)
    {
        $article = $this->articleService->update($article, $request->all());

        session()->flash('status', '記事を保存しました。');

        return redirect()->route($this->routePrefix . 'edit', ['article' => $article]);
    }


    public function destroy(Article $article)
    {
        $article->delete();
        session()->flash('status', '記事を削除しました。');
        return redirect()->route($this->routePrefix . 'list');
    }


}
