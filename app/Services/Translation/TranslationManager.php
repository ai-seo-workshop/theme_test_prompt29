<?php

namespace App\Services\Translation;

class TranslationManager
{
    protected string $theme;
    protected ?object $themeTranslation = null;

    public function __construct()
    {
        $this->theme = config('theme.active', 'techlysupport');
        $this->loadThemeTranslation();
    }

    /**
     * 加载主题专属翻译类
     */
    protected function loadThemeTranslation(): void
    {
        $className = "App\\Services\\Translation\\Themes\\" . ucfirst($this->theme) . "Translation";

        if (class_exists($className)) {
            $this->themeTranslation = new $className();
        }
    }

    /**
     * 获取翻译(带 fallback)
     * 优先级: 主题翻译 → 公共翻译
     */
    public function get(string $key, string $locale): string
    {
        // 1. 尝试当前主题翻译
        if ($this->themeTranslation && method_exists($this->themeTranslation, $key)) {
            $result = $this->themeTranslation->$key($locale);
            if (!empty($result)) {
                return $result;
            }
        }

        // 2. Fallback 到默认主题翻译
        $defaultTheme = config('theme.default', 'aboutinsider');
        if ($this->theme !== $defaultTheme) {
            $defaultClassName = "App\\Services\\Translation\\Themes\\" . ucfirst($defaultTheme) . "Translation";
            if (class_exists($defaultClassName)) {
                $defaultTranslation = new $defaultClassName();
                if (method_exists($defaultTranslation, $key)) {
                    $result = $defaultTranslation->$key($locale);
                    if (!empty($result)) {
                        return $result;
                    }
                }
            }
        }

        // 3. Fallback 到公共翻译 MaterielTask
        if (method_exists(\App\Models\MaterielTask::class, $key)) {
            return \App\Models\MaterielTask::$key($locale);
        }

        return '';
    }

    /**
     * 魔术方法,支持直接调用
     */
    public function __call($name, $arguments)
    {
        if (count($arguments) === 1) {
            return $this->get($name, $arguments[0]);
        }
        return '';
    }
}
