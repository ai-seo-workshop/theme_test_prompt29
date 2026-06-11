<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 注册翻译管理器为单例
        $this->app->singleton('translation', function ($app) {
            return new \App\Services\Translation\TranslationManager();
        });

        // 请求级别绑定 ThemeManager (每次请求创建新实例,支持多站点)
        $this->app->bind(\App\Services\ThemeManager::class, function ($app) {
            return new \App\Services\ThemeManager();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('randomBgcolor', function ($expression) {
            return "<?php echo Arr::random([{$expression}]); ?>";
        });

        // 注意：view()->share() 已移至 ViewServiceProvider::boot() 中的 View::composer
        // 原因：boot() 在请求进来之前执行，此时 IdentifySite 还未运行，ThemeManager 读到的是默认主题
    }
}
