<?php

namespace App\Http\Middleware;

use Closure;

class Published
{
    /**
     * 非公開記事を404にするミドルウェア
     *
     * @param $request
     * @param Closure $next
     * @param $type
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if ('article' == $type) {
            $article = $request->route()->article;
            if (false == $article->isPublish()) {
                abort(404);
            }
        }

        return $next($request);
    }
}
