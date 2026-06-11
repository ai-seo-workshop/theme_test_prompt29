<?php

namespace App\Console\Commands;

use App\Models\Site;
use App\Services\SitemapService;
use Illuminate\Console\Command;

class CreateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成站点地图';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('开始生成sitemap：');
        // 生成sitemap
        $sitemapService = new SitemapService();
        $site = Site::query()->where('domain', config('app.domain'))->first();
        if($site && $site->languages && count($site->languages) > 1) {
            $sitemapService->createSiteMap($site->languages);
        } else {
            $sitemapService->createSingleLanguage();
        }


        $this->info('sitemap生成完成：');
    }
}
