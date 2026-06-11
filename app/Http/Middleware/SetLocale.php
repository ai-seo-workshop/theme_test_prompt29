<?php

namespace App\Http\Middleware;

use App\Services\CategoryService;
use Closure;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $locale
     * @return mixed
     */
    public function handle($request, Closure $next, $locale = null)
    {
        // 如果直接传入了语言参数（如 setLocale:en），使用它
        if ($locale) {
            app()->setLocale($locale);
            return $next($request);
        }

        // 否则从路由参数中获取
        $routeLocale = $request->route('locale');

        // 从 config 读取当前站点支持的语言列表（由 IdentifySite 注入）
        $defaultLanguage     = config('app.default_language', config('app.default_language'));
        $nonDefaultLanguages = config('app.non_default_languages', []);

        if ($routeLocale) {
            // 路由中有 locale 参数（非默认语言路由）
            // 如果语言不在支持列表中，返回 404，防止无效语言前缀被误处理
            if (!in_array($routeLocale, $nonDefaultLanguages)) {
                abort(404);
            }
            app()->setLocale($routeLocale);
        } else {
            // 无 locale 参数（默认语言路由），使用站点默认语言
            app()->setLocale($defaultLanguage);
        }

        return $next($request);
    }
}
