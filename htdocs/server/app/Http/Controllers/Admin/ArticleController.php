<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleSaveRequest;
use App\Models\Article\Article;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\CategoryRepository;
use App\Services\Article\ArticleService;
use Illuminate\Http\Request;

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
        $paginate = $this->articleRepository->getPaginate(20);

        return view($this->viewPrefix . 'list')
            ->with('paginate', $paginate);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        // 初回のみ
        if (false == $request->session()->has('errors')
        ) {
            // 破棄
            $request->flush();

            // 初期値
            $values = [
            ];

            $request->session()->flashInput($values);
        }

        $categories = $this->categoryRepository->all();

        return view($this->viewPrefix . 'form')
            ->with('actionUrl', route($this->routePrefix . 'store'))
            ->with('categories', $categories);
    }

    public function store(ArticleSaveRequest $request)
    {
        $article = $this->articleService->create($request->all());

        session()->flash('status', '記事を保存しました。');

        return redirect()->route($this->routePrefix . 'edit', ['article' => $article]);
    }


    public function edit(Article $article, Request $request)
    {
        // 初回のみ
        if (false == $request->session()->has('errors')
        ) {
            // 破棄
            $request->flush();

            // 初期値
            $values = [
                'category_id' => $article->category_id,
                'title'       => $article->title,
                'body'        => $article->body,
                'date'        => $article->date,
                'is_publish'  => $article->is_publish,
            ];

            $request->session()->flashInput($values);
        }

        $categories = $this->categoryRepository->all();

        return view($this->viewPrefix . 'form')
            ->with('actionUrl', route($this->routePrefix . 'update', ['article' => $article->id]))
            ->with('categories', $categories);
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
        return redirect()->route($this->routePrefix . 'list');
    }


}
