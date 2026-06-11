<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes - 多语言博客系统
|--------------------------------------------------------------------------
|
| 路由结构说明：
|
| 默认语言（无前缀，由 sites.default_language 决定）:
|   首页：        /
|   分类列表：    /{category}
|   文章详情：    /blogs/{title_uniq}
|   公共页面：    /about, /contact, /privacy, /terms
|
| 其他语言（带语言前缀，由 sites.languages 决定）:
|   首页：        /{lang}/
|   分类列表：    /{lang}/{category}
|   文章详情：    /{lang}/blogs/{title_uniq}
|   公共页面：    /{lang}/about, /{lang}/contact, etc.
|
| 注意：语言配置由 IdentifySite 中间件在请求阶段注入 config，
|       路由注册发生在框架启动阶段（早于中间件），
|       因此不能在此处依赖动态 config 做路由过滤。
|       语言合法性校验统一交给 SetLocale 中间件处理。
|
*/

// ========================================
// 其他语言路由（带语言前缀）
// ========================================
// 不使用 where 限制 locale，因为路由注册时 IdentifySite 尚未执行，
// 无法从 config 读到合法语言列表。合法性由 SetLocale 中间件校验。
Route::group([
    'prefix'     => '{locale}',
    'where'      => ['locale' => '[a-z]{2}'],
    'middleware' => ['web', 'setLocale'],
], function () {

    Route::get('/', [BlogController::class, 'index'])
        ->name('home.localized');

    Route::get('/about', [PageController::class, 'about'])
        ->name('about.localized');

    Route::get('/contact', [PageController::class, 'contact'])
        ->name('contact.localized');

    Route::get('/privacy', [PageController::class, 'privacy'])
        ->name('privacy.localized');

    Route::get('/terms', [PageController::class, 'terms'])
        ->name('terms.localized');

    Route::get('/{category}', [BlogController::class, 'category'])
        ->where('category', '[\da-z\-]+')
        ->name('category.localized');

    Route::get('/blogs/{title_uniq}', [BlogController::class, 'show'])
        ->name('blog.show.localized');

    Route::fallback([PageController::class, 'error']);
});

// ========================================
// 默认语言路由（无前缀）
// ========================================
// 不传语言参数，让 SetLocale 中间件从 config('app.default_language') 读取
Route::group([
    'middleware' => ['web', 'setLocale'],
], function () {

    Route::get('/', [BlogController::class, 'index'])
        ->name('home');

    Route::get('/about', [PageController::class, 'about'])
        ->name('about');

    Route::get('/contact', [PageController::class, 'contact'])
        ->name('contact');

    Route::get('/privacy', [PageController::class, 'privacy'])
        ->name('privacy');

    Route::get('/terms', [PageController::class, 'terms'])
        ->name('terms');

    Route::get('/{category}', [BlogController::class, 'category'])
        ->where('category', '[\da-z\-]+')
        ->name('category');

    Route::get('/blogs/{title_uniq}', [BlogController::class, 'show'])
        ->name('blog.show');

    Route::fallback([PageController::class, 'error']);
});

Route::fallback([PageController::class, 'error'])->middleware(['web', 'setLocale']);

