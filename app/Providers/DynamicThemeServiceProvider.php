<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use App\Models\Site;

class DynamicThemeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        $this->setThemeByDomain();
    }

    protected function setThemeByDomain(): void
    {
        try {
            $domain = request()->getHost();
            $site = Site::findByDomain($domain);

            if ($site) {
                $activeTheme = $site->getActiveTheme();
                Config::set('theme.active', $activeTheme);

                if ($site->default_theme) {
                    Config::set('theme.default', $site->default_theme);
                }

                Config::set('app.supported_languages', $site->getLanguagesArray());
                Config::set('app.default_language', $site->getDefaultLanguage());
            }
        } catch (\Exception $e) {
            Log::warning("Failed to load theme from database: {$e->getMessage()}");
        }
    }

    public function register()
    {
        //
    }
}
