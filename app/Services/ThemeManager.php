<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class ThemeManager
{
    protected string $theme;
    protected ?string $defaultTheme = null;
    protected string $fallback;
    protected ?string $parentTheme = null;
    protected ?array $themeConfig = null;

    public function __construct()
    {
        $this->theme = config('theme.active', 'techlysupport');
        $this->defaultTheme = config('theme.default');
        $this->fallback = config('theme.fallback', 'techlysupport');
    }

    public function active(): string
    {
        return $this->theme;
    }

    public function defaultTheme(): ?string
    {
        return $this->defaultTheme;
    }

    /**
     * 获取 parentTheme (延迟加载)
     */
    protected function getParentTheme(): ?string
    {
        if ($this->themeConfig === null) {
            $this->config(); // 触发配置加载
        }
        return $this->parentTheme;
    }

    /**
     * 获取主题配置(带缓存,只读取一次)
     */
    public function config(): array
    {
        if ($this->themeConfig !== null) {
            return $this->themeConfig;
        }

        // parentTheme 来自数据库 sites.default_theme (通过 DynamicThemeServiceProvider 设置)
        if ($this->defaultTheme && $this->defaultTheme !== $this->theme) {
            $this->parentTheme = $this->defaultTheme;
        }

        // 从 config/theme.php 读取配置 (替代 JSON 文件)
        $this->themeConfig = config("theme.configs.{$this->theme}", []);

        return $this->themeConfig;
    }

    /**
     * 获取主题视图路径 (四层 fallback)
     */
    public function view(string $template): string
    {
        $themePath = "themes.{$this->theme}.{$template}";
        if (view()->exists($themePath)) {
            return $themePath;
        }

        $parentTheme = $this->getParentTheme();
        if ($parentTheme) {
            $parentPath = "themes.{$parentTheme}.{$template}";
            if (view()->exists($parentPath)) {
                return $parentPath;
            }
        }

        if ($this->defaultTheme && $this->defaultTheme !== $this->theme) {
            $defaultPath = "themes.{$this->defaultTheme}.{$template}";
            if (view()->exists($defaultPath)) {
                return $defaultPath;
            }
        }

        return "themes.{$this->fallback}.{$template}";
    }

    public function css(string $file): string
    {
        // 本地环境:返回带主题目录的路径
        if (app()->environment('local')) {
            return $this->getCssWithTheme($file);
        }

        // 生产环境:返回不带主题目录,交给 Nginx 处理
        return "/css/{$file}";
    }

    public function js(string $file): string
    {
        if (app()->environment('local')) {
            return $this->getJsWithTheme($file);
        }
        return "/js/{$file}";
    }

    public function image(string $file): string
    {
        if (app()->environment('local')) {
            return $this->getImageWithTheme($file);
        }
        return "/images/{$file}";
    }

    /**
     * 获取带主题目录的 CSS 路径(本地环境使用)
     */
    protected function getCssWithTheme(string $file): string
    {
        $themePath = public_path("css/{$this->theme}/{$file}");
        if (File::exists($themePath)) {
            return "/css/{$this->theme}/{$file}";
        }

        $parentTheme = $this->getParentTheme();
        if ($parentTheme) {
            $parentPath = public_path("css/{$parentTheme}/{$file}");
            if (File::exists($parentPath)) {
                return "/css/{$parentTheme}/{$file}";
            }
        }

        if ($this->defaultTheme && $this->defaultTheme !== $this->theme) {
            $defaultPath = public_path("css/{$this->defaultTheme}/{$file}");
            if (File::exists($defaultPath)) {
                return "/css/{$this->defaultTheme}/{$file}";
            }
        }

        return "/css/{$this->fallback}/{$file}";
    }

    /**
     * 获取带主题目录的 JS 路径(本地环境使用)
     */
    protected function getJsWithTheme(string $file): string
    {
        $themePath = public_path("js/{$this->theme}/{$file}");
        if (File::exists($themePath)) {
            return "/js/{$this->theme}/{$file}";
        }

        $parentTheme = $this->getParentTheme();
        if ($parentTheme) {
            $parentPath = public_path("js/{$parentTheme}/{$file}");
            if (File::exists($parentPath)) {
                return "/js/{$parentTheme}/{$file}";
            }
        }

        if ($this->defaultTheme && $this->defaultTheme !== $this->theme) {
            $defaultPath = public_path("js/{$this->defaultTheme}/{$file}");
            if (File::exists($defaultPath)) {
                return "/js/{$this->defaultTheme}/{$file}";
            }
        }

        return "/js/{$this->fallback}/{$file}";
    }

    /**
     * 获取带主题目录的图片路径(本地环境使用)
     */
    protected function getImageWithTheme(string $file): string
    {
        $themePath = public_path("images/{$this->theme}/{$file}");
        if (File::exists($themePath)) {
            return "/images/{$this->theme}/{$file}";
        }

        $parentTheme = $this->getParentTheme();
        if ($parentTheme) {
            $parentPath = public_path("images/{$parentTheme}/{$file}");
            if (File::exists($parentPath)) {
                return "/images/{$parentTheme}/{$file}";
            }
        }

        if ($this->defaultTheme && $this->defaultTheme !== $this->theme) {
            $defaultPath = public_path("images/{$this->defaultTheme}/{$file}");
            if (File::exists($defaultPath)) {
                return "/images/{$this->defaultTheme}/{$file}";
            }
        }

        return "/images/{$this->fallback}/{$file}";
    }

    /**
     * 获取主题 Query 类 (四层 fallback)
     */
    public function queryClass(string $name): string
    {
        $themeName = ucfirst($this->theme);
        $class = "App\\Http\\Queries\\Themes\\{$themeName}\\{$name}Query";
        if (class_exists($class)) {
            return $class;
        }

        $parentTheme = $this->getParentTheme();
        if ($parentTheme) {
            $parentName = ucfirst($parentTheme);
            $parentClass = "App\\Http\\Queries\\Themes\\{$parentName}\\{$name}Query";
            if (class_exists($parentClass)) {
                return $parentClass;
            }
        }

        if ($this->defaultTheme && $this->defaultTheme !== $this->theme) {
            $defaultName = ucfirst($this->defaultTheme);
            $defaultClass = "App\\Http\\Queries\\Themes\\{$defaultName}\\{$name}Query";
            if (class_exists($defaultClass)) {
                return $defaultClass;
            }
        }

        $fallbackName = ucfirst($this->fallback);
        return "App\\Http\\Queries\\Themes\\{$fallbackName}\\{$name}Query";
    }
}

