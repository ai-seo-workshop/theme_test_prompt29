<?php

namespace App\Services\Translation\Themes;

class AboutinsiderTranslation
{
    public function editorial_picks($locale): string
    {
        $translations = [
            'en' => 'Editorial Picks',
            'de' => 'Redaktionelle Auswahl',
            'fr' => 'Sélection éditoriale',
            'es' => 'Selección editorial',
            'pt' => 'Seleção editorial',
            'it' => 'Selezione editoriale',
            'nl' => 'Redactionele keuzes',
            'pl' => 'Wybór redakcji',
            'zh' => '编辑精选',
            'ja' => '編集部のおすすめ',
            'ko' => '편집장 추천',
        ];
        return data_get($translations, $locale, data_get($translations, 'en', ''));
    }

    public function hot_articles($locale): string
    {
        $translations = [
            'en' => 'Hot Articles',
            'de' => 'Beliebte Artikel',
            'fr' => 'Articles populaires',
            'es' => 'Artículos populares',
            'pt' => 'Artigos populares',
            'it' => 'Articoli popolari',
            'nl' => 'Populaire artikelen',
            'pl' => 'Popularne artykuły',
            'zh' => '热门文章',
            'ja' => '人気記事',
            'ko' => '인기 기사',
        ];
        return data_get($translations, $locale, data_get($translations, 'en', ''));
    }

    public function this_week_hot($locale): string
    {
        $translations = [
            'en' => "This Week's Hot",
            'de' => 'Diese Woche beliebt',
            'fr' => 'Populaire cette semaine',
            'es' => 'Lo más visto esta semana',
            'pt' => 'Em alta esta semana',
            'it' => 'Popolare questa settimana',
            'nl' => 'Deze week populair',
            'pl' => 'Popularne w tym tygodniu',
            'zh' => '本周热门',
            'ja' => '今週のホット',
            'ko' => '이번 주 인기',
        ];
        return data_get($translations, $locale, data_get($translations, 'en', ''));
    }

    public function error_404_desc($locale): string
    {
        $translations = [
            'en' => "The page you're looking for doesn't exist or has been moved. Please check the URL or return to the homepage.",
            'de' => 'Die gesuchte Seite existiert nicht oder wurde verschoben. Bitte überprüfen Sie die URL oder kehren Sie zur Startseite zurück.',
            'fr' => "La page que vous recherchez n'existe pas ou a été déplacée. Veuillez vérifier l'URL ou revenir à la page d'accueil.",
            'es' => 'La página que buscas no existe o ha sido movida. Verifica la URL o regresa a la página de inicio.',
            'pt' => 'A página que você está procurando não existe ou foi movida. Verifique a URL ou volte para a página inicial.',
            'it' => "La pagina che stai cercando non esiste o è stata spostata. Controlla l'URL o torna alla homepage.",
            'nl' => 'De pagina die u zoekt bestaat niet of is verplaatst. Controleer de URL of ga terug naar de startpagina.',
            'pl' => 'Strona, której szukasz, nie istnieje lub została przeniesiona. Sprawdź adres URL lub wróć na stronę główną.',
            'zh' => '您查找的页面不存在或已被移动，请检查网址或返回首页。',
            'ja' => 'お探しのページは存在しないか、移動されました。URLを確認するか、ホームページにお戻りください。',
            'ko' => '찾으시는 페이지가 존재하지 않거나 이동되었습니다. URL을 확인하거나 홈으로 돌아가세요.',
        ];
        return data_get($translations, $locale, data_get($translations, 'en', ''));
    }
}
