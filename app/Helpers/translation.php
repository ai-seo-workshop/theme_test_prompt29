<?php

if (!function_exists('trans_theme')) {
    /**
     * 获取主题翻译
     */
    function trans_theme(string $key, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return app('translation')->get($key, $locale);
    }
}
