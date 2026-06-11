<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterielTask extends Model
{
    protected $table = 'materiel_tasks';

    protected $fillable = [
        'site_id', 'language_code', 'type', 'h1', 'path', 'slogan', 'seo_title', 'seo_desc', 'content', 'category_id'
    ];

    // 类型常量
    const TYPE_HOME = 1;
    const TYPE_ABOUT = 2;
    const TYPE_CONTACT = 3;
    const TYPE_POLICY = 4;
    const TYPE_LOGO = 5;
    const TYPE_ICON = 6;
    const TYPE_TERMS = 7;
    const TYPE_CATEGORY =8;

    public static function LANGUAGES(): array
    {
        // 所有已知语言的名称映射（可按需扩展）
        $allLanguageNames = [
            'en' => 'English',
            'de' => 'Deutsch',
            'fr' => 'Français',
            'es' => 'Español',
            'zh' => '中文',
            'ja' => '日本語',
            'ko' => '한국어',
            'pt' => 'Português',
            'it' => 'Italiano',
            'ru' => 'Русский',
        ];

        // 从 config 读取当前站点支持的语言列表
        $supported = config('app.supported_languages', [config('app.default_language')]);

        // 返回 [code => name] 格式，只包含当前站点支持的语言
        $result = [];
        foreach ($supported as $code) {
            $result[$code] = $allLanguageNames[$code] ?? $code;
        }
        return $result;
    }

    public static function SUPPORTS($locale) {
        $support = [
            'en' => [
                2 => ['name'=>'About', 'uri'=>'about'],
                3 => ['name'=>'Contact', 'uri'=>'contact'],
                4 => ['name'=>'Privacy', 'uri'=>'privacy'],
                7 => ['name'=>'Terms', 'uri'=>'terms']
            ],
            'de' => [
                2 => ['name'=>'Über uns', 'uri'=>'about'],
                3 => ['name'=>'Kontakt', 'uri'=>'contact'],
                4 => ['name'=>'Datenschutz', 'uri'=>'privacy'],
                7 => ['name'=>'Bedingungen', 'uri'=>'terms']
            ],
            'fr' => [
                2 => ['name'=>'À propos', 'uri'=>'about'],
                3 => ['name'=>'Contact', 'uri'=>'contact'],
                4 => ['name'=>'Confidentialité', 'uri'=>'privacy'],
                7 => ['name'=>'Conditions', 'uri'=>'terms']
            ],
            'es' => [
                2 => ['name'=>'Acerca de', 'uri'=>'about'],
                3 => ['name'=>'Contacto', 'uri'=>'contact'],
                4 => ['name'=>'Privacidad', 'uri'=>'privacy'],
                7 => ['name'=>'Términos', 'uri'=>'terms']
            ],
            'it' => [
                2 => ['name'=>'A proposito', 'uri'=>'about'],
                3 => ['name'=>'Contatti', 'uri'=>'contact'],
                4 => ['name'=>'Politica', 'uri'=>'privacy'],
                7 => ['name'=>'Condizioni', 'uri'=>'terms']
            ],
            'tr' => [
                2 => ['name'=>'Hakkımızda', 'uri'=>'about'],
                3 => ['name'=>'İletişim', 'uri'=>'contact'],
                4 => ['name'=>'Gizlilik', 'uri'=>'privacy'],
                7 => ['name'=>'Şartlar', 'uri'=>'terms']
            ],
            'pl' => [
                2 => ['name'=>'O nas', 'uri'=>'about'],
                3 => ['name'=>'Kontakt', 'uri'=>'contact'],
                4 => ['name'=>'Prywatność', 'uri'=>'privacy'],
                7 => ['name'=>'Warunki', 'uri'=>'terms']
            ],
            'hu' => [
                2 => ['name'=>'Rólunk', 'uri'=>'about'],
                3 => ['name'=>'Kapcsolat', 'uri'=>'contact'],
                4 => ['name'=>'Adatvédelem', 'uri'=>'privacy'],
                7 => ['name'=>'Feltételek', 'uri'=>'terms']
            ],
            'nl' => [
                2 => ['name'=>'Over ons', 'uri'=>'about'],
                3 => ['name'=>'Contact', 'uri'=>'contact'],
                4 => ['name'=>'Privacybeleid', 'uri'=>'privacy'],
                7 => ['name'=>'Voorwaarden', 'uri'=>'terms']
            ]
        ];
        return data_get($support, $locale, []);
    }

    public static function home($locale) {
        $home = [
            'en' => 'Home',
            'de' => 'Startseite',
            'fr' => 'Accueil',
            'es' => 'Inicio',
            'it' => 'Casa',
            'tr' => 'Ev',
            'pl' => 'Dom',
            'hu' => 'Otthon',
            'nl' => 'Thuis'
        ];
        return data_get($home, $locale, '');
    }

    public static function recent_posts($locale) {
        $recent_posts = [
            'en' => 'Recent Posts',
            'de' => 'Neueste Beiträge',
            'fr' => 'Articles Récents',
            'es' => 'Publicaciones Recientes',
            'it' => 'Articoli recenti',
            'tr' => 'Son Yazılar',
            'pl' => 'Ostatnie posty',
            'hu' => 'Legutóbbi bejegyzések',
            'nl' => 'Recente berichten'
        ];
        return data_get($recent_posts, $locale, '');
    }

    public static function related_posts($locale) {
        $related_posts = [
            'en'=>'Related Posts',
            'de'=>'Verwandte Beiträge',
            'fr'=>'Articles connexes',
            'es'=>'Publicaciones relacionadas',
            'it' => 'Post correlati',
            'tr' => 'İlgili Yazılar',
            'pl' => 'Powiązane posty',
            'hu' => 'Kapcsolódó bejegyzések',
            'nl' => 'Gerelateerde berichten'
        ];
        return data_get($related_posts, $locale, '');
    }

    public static function read_article($locale) {
        $read_article = [
            'en' => 'Read Article',
            'de' => 'Artikel lesen',
            'fr' => 'Lire l’article',
            'es' => 'Leer el artículo',
            'it' => "Leggi l'articolo",
            'tr' => 'Makaleyi okuyun',
            'pl' => 'Przeczytaj artykuł',
            'hu' => 'Cikk olvasása',
            'nl' => 'Lees het artikel'
        ];
        return data_get($read_article, $locale, '');
    }

    public static function hot_topics($locale) {
        $hot_topics = [
            'en' => 'Hot Topics',
            'de' => 'Aktuelle Themen',
            'fr' => 'Sujets populaires',
            'es' => 'Temas candentes',
            'it' => 'Argomenti di tendenza',
            'tr' => 'Güncel Konular',
            'pl' => 'Gorące tematy',
            'hu' => 'Forró témák',
            'nl' => 'Actuele onderwerpen'
        ];
        return data_get($hot_topics, $locale, '');
    }

    public static function page_not_found($locale) {
        $page_not_found = [
            'en' => 'Oops! Page Not Found',
            'de' => 'Ups! Seite nicht gefunden',
            'fr' => 'Oups ! Page introuvable',
            'es' => '¡Ups! Página no encontrada',
            'it' => 'Ops! Pagina non trovata',
            'tr' => 'Ups! Sayfa bulunamadı.',
            'pl' => 'Ups! Strona nie znaleziona',
            'hu' => 'Hoppá! Az oldal nem található',
            'nl' => 'Oeps! Pagina niet gevonden'
        ];
        return data_get($page_not_found, $locale, '');
    }

    public static function desc_1_404($locale) {
        $desc_1_404 = [
            'en' => "The page you're looking for seems to have gone on a training run and hasn't come back yet.",
            'de' => "Die Seite, die du suchst, scheint zu einer Trainingsrunde aufgebrochen zu sein und ist noch nicht zurück.",
            'fr' => "La page que vous recherchez semble être partie faire un entraînement et n’est pas encore revenue.",
            'es' => "La página que buscas parece haberse ido a hacer un entrenamiento y aún no ha regresado.",
            'it' => 'La pagina che stai cercando sembra essere andata in fase di test e non è ancora tornata disponibile.',
            'tr' => 'Aradığınız sayfa bir eğitim çalışmasına çıkmış gibi görünüyor ve henüz geri dönmedi.',
            'pl' => 'Strona, której szukasz, najwyraźniej odbyła trening i jeszcze nie powróciła.',
            'hu' => 'Úgy tűnik, a keresett oldal egy betanítási folyamaton ment keresztül, és még nem tért vissza.',
            'nl' => 'De pagina die u zoekt lijkt tijdelijk offline te zijn en is nog niet teruggekeerd.'
        ];
        return data_get($desc_1_404, $locale, '');
    }

    public static function desc_2_404($locale) {
        $desc_2_404 = [
            'en' => "Don't worry, there are plenty of other great places to explore!",
            'de' => "Keine Sorge, es gibt noch viele andere großartige Seiten zu entdecken!",
            'fr' => "Ne vous inquiétez pas, il y a plein d’autres endroits intéressants à découvrir !",
            'es' => "No te preocupes, ¡hay muchos otros lugares increíbles por explorar!",
            'it' => 'Non preoccuparti, ci sono tantissimi altri posti meravigliosi da esplorare!',
            'tr' => 'Merak etmeyin, keşfedilecek daha birçok harika yer var!',
            'pl' => 'Nie martw się, jest mnóstwo innych wspaniałych miejsc do odkrycia!',
            'hu' => 'Ne aggódj, rengeteg más nagyszerű hely is van, amit felfedezhetsz!',
            'nl' => 'Geen zorgen, er zijn nog genoeg andere fantastische plekken om te ontdekken!'
        ];
        return data_get($desc_2_404, $locale, '');
    }

    public static function go_to_homepage($locale) {
        $go_to_homepage = [
            'en'=>'Go to Homepage',
            'de'=>'Zur Startseite',
            'fr'=>'Aller à l’accueil',
            'es'=>'Ir a la página de inicio',
            'it' => 'Vai alla homepage',
            'tr' => 'Ana sayfaya git',
            'pl' => 'Przejdź do strony głównej',
            'hu' => 'Ugrás a kezdőlapra',
            'nl' => 'Ga naar de homepage'
        ];
        return data_get($go_to_homepage, $locale, '');
    }

    public static function popular_destinations($locale) {
        $popular_destinations = [
            'en'=>'Popular Destinations',
            'de'=>'Beliebte Themen',
            'fr'=>'Destinations populaires',
            'es'=>'Destinos populares',
            'it' => 'Destinazioni popolari',
            'tr' => 'Popüler Destinasyonlar',
            'pl' => 'Popularne miejsca docelowe',
            'hu' => 'Népszerű úti célok',
            'nl' => 'Populaire bestemmingen'
        ];
        return data_get($popular_destinations, $locale, '');
    }

    public static function detail_content($locale) {
        $detail_content = [
            'en'=>'Content',
            'de'=>'Inhalt',
            'fr'=>'Contenu',
            'es'=>'Contenido',
            'it' => 'Contenuto',
            'tr' => 'İçerik',
            'pl' => 'Treść',
            'hu' => 'Tartalom',
            'nl' => 'Inhoud'
        ];
        return data_get($detail_content, $locale, '');
    }

    public static function popular_articles($locale) {
        $popular_articles = [
            'en'=>'Popular Articles',
            'de'=>'Beliebte Artikel',
            'fr'=>'Articles populaires',
            'es'=>'Artículos populares',
            'it' => 'Articoli popolari',
            'tr' => 'Popüler Makaleler',
            'pl' => 'Popularne artykuły',
            'hu' => 'Népszerű cikkek',
            'nl' => 'Populaire artikelen'
        ];
        return data_get($popular_articles, $locale, '');
    }

    public static function contact_us($locale) {
        $contact_us = [
            'en'=>'Contact Us',
            'de'=>'Kontaktieren Sie uns',
            'fr'=>'Contactez-nous',
            'es'=>'Contáctanos',
            'it' => 'Contattaci',
            'tr' => 'Bize Ulaşın',
            'pl' => 'Skontaktuj się z nami',
            'hu' => 'Kapcsolat',
            'nl' => 'Neem contact met ons op'
        ];
        return data_get($contact_us, $locale, '');
    }

    public static function contact_us_desc($locale) {
        $contact_us_desc = [
            'en'=>"Have questions? We're here to help!",
            'de'=>"Haben Sie Fragen? Wir sind für Sie da!",
            'fr'=>'Des questions ? Nous sommes là pour vous aider !',
            'es'=>'¿Tienes preguntas? ¡Estamos aquí para ayudarte!',
            'it' => 'Hai domande? Siamo qui per aiutarti!',
            'tr' => 'Sorularınız mı var? Yardımcı olmak için buradayız!',
            'pl' => 'Masz pytania? Jesteśmy tu, żeby pomóc!',
            'hu' => 'Kérdései vannak? Segítünk!',
            'nl' => 'Heb je vragen? Wij helpen je graag!'
        ];
        return data_get($contact_us_desc, $locale, '');
    }

    public static function get_in_touch($locale) {
        $get_in_touch = [
            'en'=>'Get in Touch',
            'de'=>'Kontakt aufnehmen',
            'fr'=>'Entrer en contact',
            'es'=>'Ponte en contacto',
            'it' => 'Contattaci',
            'tr' => 'İletişime Geçin',
            'pl' => 'Skontaktuj się z nami',
            'hu' => 'Kapcsolatfelvétel',
            'nl' => 'Neem contact op'
        ];
        return data_get($get_in_touch, $locale, '');
    }

    public static function office_topics($locale) {
        $office_topics = [
            'en'=>'Office Topics',
            'de'=>'Bürothemen',
            'fr'=>'Thèmes de Bureau',
            'es'=>'Temas de Oficina',
            'it' => "Argomenti d'ufficio",
            'tr' => 'Ofis Konuları',
            'pl' => 'Tematy biurowe',
            'hu' => 'Irodai témák',
            'nl' => 'Kantooronderwerpen'
        ];
        return data_get($office_topics, $locale, '');
    }

    public static function copyright($locale) {
        $copyright = [
            'en'=>'All rights reserved.',
            'de'=>'Alle Rechte vorbehalten.',
            'fr'=>'Tous droits réservés.',
            'es'=>'Todos los derechos reservados.',
            'it' => 'Tutti i diritti riservati.',
            'tr' => 'Her hakkı saklıdır.',
            'pl' => 'Wszelkie prawa zastrzeżone.',
            'hu' => 'Minden jog fenntartva.',
            'nl' => 'Alle rechten voorbehouden.'
        ];
        return data_get($copyright, $locale, '');
    }

//    public static function slogan($locale) {
//        $copyright = [
//            'en'=>'All the How-To Answers You Need.',
//            'de'=>'Alle Anleitungen, die Sie brauchen.',
//            'fr'=>'Toutes les réponses pratiques dont vous avez besoin.',
//            'es'=>'Todas las respuestas prácticas que necesitas.'
//        ];
//        return data_get($copyright, $locale, '');
//    }

    public static function company($locale) {
        $company = [
            'en' => 'Company',
            'de' => 'Unternehmen',
            'fr' => 'Entreprise',
            'es' => 'Empresa',
            'it' => 'Azienda',
            'tr' => 'Şirket',
            'pl' => 'Firma',
            'hu' => 'Vállalat',
            'nl' => 'Bedrijf'
        ];
        return data_get($company, $locale, '');
    }

    public static function resource($locale) {
        $resource = [
            'en' => 'Resource',
            'de' => 'Ressourcen',
            'fr' => 'Ressources',
            'es' => 'Recursos',
            'it' => 'Risorsa',
            'tr' => 'Kaynak',
            'pl' => 'Ratunek',
            'hu' => 'Forrás',
            'nl' => 'Bron'
        ];
        return data_get($resource, $locale, '');
    }

    public static function legal($locale) {
        $legal = [
            'en' => 'Legal',
            'de' => 'Rechtliche',
            'fr' => 'Juridique',
            'es' => 'Jurídico',
            'it' => 'Legale',
            'tr' => 'Yasal',
            'pl' => 'Prawny',
            'hu' => 'Jogi',
            'nl' => 'Juridisch'
        ];
        return data_get($legal, $locale, '');
    }

    public static function by($locale) {
        $by = [
            'en' => 'By',
            'de' => 'Von',
            'fr' => 'Par',
            'es' => 'Por',
            'it' => 'Di',
            'tr' => 'İle',
            'pl' => 'Przez',
            'hu' => 'Által',
            'nl' => 'Door'
        ];
        return data_get($by, $locale, '');
    }

    public static function detailPublished($locale) {
        $detailPublished = [
            'en' => 'Published',
            'de' => 'Veröffentlicht',
            'fr' => 'Publié',
            'es' => 'Publicado',
            'it' => 'Pubblicato',
            'tr' => 'Yayınlandı',
            'pl' => 'Opublikowany',
            'hu' => 'Közzétett',
            'nl' => 'Gepubliceerd'
        ];
        return data_get($detailPublished, $locale, '');
    }

    public static function filedUnder($locale) {
        $filedUnder = [
            'en' => 'Filed under',
            'de' => 'Abgelegt unter',
            'fr' => 'Classé sous',
            'es' => 'Archivado en',
            'it' => 'Archiviato sotto',
            'tr' => 'Dosya altında',
            'pl' => 'Złożono w ramach',
            'hu' => 'Kategória',
            'nl' => 'Gearchiveerd onder'
        ];
        return data_get($filedUnder, $locale, '');
    }

    public static function next($locale) {
        $next = [
            'en' => 'Next',
            'de' => 'Weiter',
            'fr' => 'Suivant',
            'es' => 'Siguiente',
            'it' => 'Successivo',
            'tr' => 'Sonraki',
            'pl' => 'Następny',
            'hu' => 'Következő',
            'nl' => 'Volgende'
        ];
        return data_get($next, $locale, '');
    }

    public static function previous($locale) {
        $previous = [
            'en' => 'Previous',
            'de' => 'Zurück',
            'fr' => 'Précédent',
            'es' => 'Anterior',
            'it' => 'Precedente',
            'tr' => 'Önceki',
            'pl' => 'Poprzedni',
            'hu' => 'Előző',
            'nl' => 'Vorige'
        ];
        return data_get($previous, $locale, '');
    }

    // 查询作用域 - 按语言过滤
    public function scopeByLanguage($query, $language)
    {
        return $query->where('language_code', $language);
    }

    // 查询作用域 - 按类型过滤
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
