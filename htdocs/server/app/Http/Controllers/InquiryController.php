<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InquiryRequest;
use App\Models\Article\Article;
use App\Repositories\Article\ArticleRepository;
use App\Services\MailService;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    protected $mailService;
    protected $articleRepository;

    protected $viewPrefix = 'inquiry.';
    protected $routePrefix = 'inquiry.';

    public function __construct(
        MailService $mailService,
        ArticleRepository $articleRepository
    )
    {
        $this->mailService = $mailService;
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * @param InquiryRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function post(InquiryRequest $request)
    {
        $request->flash();

        if ('confirm' == $request->actionType) {
            $viewFile = 'confirm';
        } else if ('send' == $request->actionType) {

            // メール送信実行
            $content = $request->only([
                'type',
                'name',
                'email',
                'body',
            ]);

            $this->mailService->sendInquiryAdminMail($content);
            $this->mailService->sendInquiryCustomerMail($request->email, $content);

            return redirect()->route($this->routePrefix . 'thanks');
        } else {
            $viewFile = 'form';
        }

        return view($this->viewPrefix . $viewFile)
            ->with('actionUrl', route($this->routePrefix . 'post'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thanks(Request $request)
    {
        return view($this->viewPrefix . 'thanks');
    }

}
