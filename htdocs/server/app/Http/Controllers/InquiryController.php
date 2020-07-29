<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InquiryRequest;
use App\Models\Article\Article;
use App\Repositories\Article\ArticleRepository;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    protected $articleRepository;

    protected $viewPrefix = 'inquiry.';
    protected $routePrefix = 'inquiry.';

    public function __construct(
        ArticleRepository $articleRepository
    )
    {
        $this->articleRepository = $articleRepository;
    }

    public function form(Request $request)
    {
        // エラーがない＝初回アクセス時のみ入力値を破棄する
        if (false == $request->session()->has('errors')
        ) {
            $request->flush();
        }

        return view($this->viewPrefix . 'form')
            ->with('actionUrl', route($this->routePrefix . 'post'));
    }

    public function post(InquiryRequest $request)
    {
        $request->flash();

        if ('confirm' == $request->actionType) {
            $viewFile = 'confirm';
        } else if ('send' == $request->actionType) {
            // TODO:
            return redirect()->route($this->routePrefix . 'thanks');
        } else {
            $viewFile = 'form';
        }

        return view($this->viewPrefix . $viewFile)
            ->with('actionUrl', route($this->routePrefix . 'post'));
    }


    public function thanks(Request $request)
    {
        return view($this->viewPrefix . 'thanks');
    }


}
