<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\MaterielTask;

class BlogController extends Controller
{

    /**
     * 首页
     */
    public function index()
    {
        $seoInfo     = $this->seoInfo(MaterielTask::TYPE_HOME);
        $categoryIds = $this->categories->pluck('id')->toArray();

        // 通用上下文，Query 类自行决定用哪些
        $context = [
            'locale'      => $this->locale,
            'categoryIds' => $categoryIds,
            'categories'  => $this->categories,
        ];

        // 动态解析主题 Query 类，由其决定需要哪些数据
        $queryClass = $this->themeManager->queryClass('Home');
        $themeData  = $queryClass::getData($context);

        return view($this->themeManager->view('home'), array_merge($themeData, [
            'crumbs' => $this->crumbs(null, null),
            'gtag'          => $this->site->gtag,
            'seoInfo'       => $seoInfo,
            'categories'    => $this->categories,
            'slogan'        => $seoInfo,
        ]));
    }

    /**
     * 分类列表页
     */
    public function category($locale = 'en', $category = null)
    {
        if ($category === null) {
            $category     = $locale;
            $this->locale = app()->getLocale();
        }

        $categoryInfo = $this->categories->where('slug', $category)->first();
        if (!$categoryInfo) {
            return response()->view($this->themeManager->view('404'), ['categories' => $this->categories,'slogan' => $this->seoInfo(MaterielTask::TYPE_HOME)], 404);
        }
        $seoInfo = $this->seoInfo(MaterielTask::TYPE_CATEGORY, $categoryInfo->id);

        $context = [
            'locale'       => $this->locale,
            'categoryInfo' => $categoryInfo,
            'categories'   => $this->categories,
        ];

        $queryClass = $this->themeManager->queryClass('Category');
        $themeData  = $queryClass::getData($context);

        if (request()->ajax()) {
            $blogs = $themeData['blogs'];
            return response()->json([
                // ✅ 修复：使用正确的视图路径
                'html' => view($this->themeManager->view('partials.article-list'), compact('blogs'))->render(),
                'pagination' => [
                    'current_page'   => $blogs->currentPage(),
                    'last_page'      => $blogs->lastPage(),
                    'has_more_pages' => $blogs->hasMorePages(),
                    'on_first_page'  => $blogs->onFirstPage(),
                ]
            ]);
        }

        return view($this->themeManager->view('category'), array_merge($themeData, [
            'crumbs'       => $this->crumbs($categoryInfo, null),
            'gtag'         => $this->site->gtag,
            'categoryInfo' => $categoryInfo,
            'seoInfo'      => $seoInfo,
            'categories'   => $this->categories,
            'slogan'       => $this->seoInfo(MaterielTask::TYPE_HOME),
        ]));
    }

    /**
     * 文章详情页
     */
    public function show($locale = 'en', $title_uniq = null)
    {
        if ($title_uniq === null) {
            $title_uniq   = $locale;
            $this->locale = app()->getLocale();
        }

        $blog = Blog::active()
            ->byLanguage($this->locale)
            ->where('title_uniq', $title_uniq)
            ->first();
        if (!$blog) {
            return response()->view($this->themeManager->view('404'), ['categories' => $this->categories, 'slogan' => $this->seoInfo(MaterielTask::TYPE_HOME)], 404);
        }

        // $blog->incrementVolume();

        $context = [
            'locale'     => $this->locale,
            'blog'       => $blog,
            'categories' => $this->categories,
        ];

        $queryClass = $this->themeManager->queryClass('BlogDetail');
        $themeData  = $queryClass::getData($context);

        return view($this->themeManager->view('blog-detail'), array_merge($themeData, [
            'crumbs'     => $this->crumbs($blog->category, $blog),
            'gtag'       => $this->site->gtag,
            'blog'       => $blog,
            'categories' => $this->categories,
            'slogan'     => $this->seoInfo(MaterielTask::TYPE_HOME),
        ]));
    }

}

