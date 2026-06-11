<?php

namespace App\Providers;

use App\Services\CategoryService;
use App\Services\ThemeManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer('*', ...) 在每次视图渲染前执行，此时已在请求周期内
        // ThemeManager 已经是 scoped 实例，拿到的就是当前请求对应的主题
        View::composer('*', function ($view) {
            $theme = app(ThemeManager::class);

            // 将 $theme 和 $themeConfig 注入所有视图（替代 AppServiceProvider 里的 view()->share）
            $view->with('theme', $theme);
            $view->with('themeConfig', $theme->config());

            // 将分类数据注入所有视图（修复之前漏掉 use 的 Bug）
            $view->with('categories', CategoryService::getActiveCategories());
        });
    }
}
