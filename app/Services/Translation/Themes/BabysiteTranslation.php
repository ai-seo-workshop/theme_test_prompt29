<?php

namespace App\Services\Translation\Themes;

class BabysiteTranslation
{
    public function homeH1($locale): string
    {
        $translations = [
//            'en' => 'Your Guide to Everyday Jewelry Style',
//            'de' => 'Ihr Leitfaden für alltagstauglichen Schmuckstil',
//            'fr' => 'Votre guide du style de bijoux au quotidien',
            'es' => 'Consejos y experiencias para correr mejor'
        ];
        return data_get($translations, $locale, '');
    }

    public function heroDesc($locale): string
    {
        $translations = [
            'en' => 'Discover bracelets, necklaces, earrings, and rings—through trends, styling tips, and practical guides.',
            'de' => 'Entdecken Sie Armbänder, Halsketten, Ohrringe und Ringe – mit Trends, Styling-Tipps und praktischen Ratgebern.',
            'fr' => 'Découvrez bracelets, colliers, boucles d\'oreilles et bagues — à travers les tendances, des conseils de style et des guides pratiques.',
            'es' => 'Descubre pulseras, collares, pendientes y anillos—con tendencias, consejos de estilo y guías prácticas.'
        ];
        return data_get($translations, $locale, '');
    }

    public function phases_title($locale): string
    {
        $titles = [
            'en' => 'Where are you right now?',
            'de' => 'Wo stehst du gerade?',
            'fr' => 'Où en es-tu actuellement?',
            'es' => '¿Dónde estás ahora mismo?'
        ];
        return data_get($titles, $locale, '');
    }

    public function phases_subtitle($locale): string
    {
        $subtitles = [
            'en' => 'Choose the area that best fits your everyday life – we sort the knowledge so you don\'t have to search for everything at once.',
            'de' => 'Wähle den Bereich, der am besten zu deinem Alltag passt – wir sortieren das Wissen so, dass du nicht alles gleichzeitig suchen musst.',
            'fr' => 'Choisis le domaine qui correspond le mieux à ton quotidien – nous trions les connaissances pour que tu n\'aies pas à tout chercher en même temps.',
            'es' => 'Elige el área que mejor se adapte a tu vida cotidiana – organizamos el conocimiento para que no tengas que buscar todo al mismo tiempo.'
        ];
        return data_get($subtitles, $locale, '');
    }

    public function life_situation($locale): string
    {
        $labels = [
            'en' => 'Life Situation',
            'de' => 'Lebenssituation',
            'fr' => 'Situation de vie',
            'es' => 'Situación de vida'
        ];
        return data_get($labels, $locale, '');
    }

    public function latest_articles_title($locale): string
    {
        $titles = [
            'en' => 'New on our portal',
            'de' => 'Neu auf unserem Portal',
            'fr' => 'Nouveau sur notre portail',
            'es' => 'Nuevo en nuestro portal'
        ];
        return data_get($titles, $locale, '');
    }

    public function about_title($locale): string
    {
        $titles = [
            'en' => 'About Us',
            'de' => 'Über uns',
            'fr' => 'À propos de nous',
            'es' => 'Sobre nosotros'
        ];
        return data_get($titles, $locale, '');
    }

    public function about_lead($locale): string
    {
        $leads = [
            'en' => 'A moment of calm – once a week.',
            'de' => 'Ein Moment der Ruhe – einmal pro Woche.',
            'fr' => 'Un moment de calme – une fois par semaine.',
            'es' => 'Un momento de calma – una vez por semana.'
        ];
        return data_get($leads, $locale, '');
    }

    public function about_body_1($locale): string
    {
        $bodies = [
            'en' => 'Texts about pregnancy, baby time and family life – written by a mother and an expecting mother.',
            'de' => 'Texte über Schwangerschaft, Babyzeit und Familienleben – geschrieben von einer Mutter und einer werdenden Mutter.',
            'fr' => 'Textes sur la grossesse, la période de bébé et la vie de famille – écrits par une mère et une future mère.',
            'es' => 'Textos sobre el embarazo, la época del bebé y la vida familiar – escritos por una madre y una futura madre.'
        ];
        return data_get($bodies, $locale, '');
    }

    public function about_body_2($locale): string
    {
        $bodies = [
            'en' => 'This blog was born from our own and shared experiences. It doesn\'t want to explain, promise or accelerate anything, but rather quietly capture thoughts, questions and observations – just as they arise in everyday life.',
            'de' => 'Dieses Blog ist aus eigenen und miterlebten Erfahrungen entstanden. Es möchte nichts erklären, nichts versprechen und nichts beschleunigen, sondern Gedanken, Fragen und Beobachtungen ruhig festhalten – so, wie sie im Alltag auftauchen.',
            'fr' => 'Ce blog est né de nos propres expériences et de celles que nous avons vécues ensemble. Il ne veut rien expliquer, rien promettre ni rien accélérer, mais simplement saisir calmement les pensées, les questions et les observations – telles qu\'elles surgissent au quotidien.',
            'es' => 'Este blog nació de nuestras propias experiencias y de las compartidas. No quiere explicar, prometer ni acelerar nada, sino capturar tranquilamente pensamientos, preguntas y observaciones, tal como surgen en la vida cotidiana.'
        ];
        return data_get($bodies, $locale, '');
    }

    public function about_point_1_title($locale): string
    {
        $titles = [
            'en' => 'Real Experiences',
            'de' => 'Echte Erfahrungen',
            'fr' => 'Expériences réelles',
            'es' => 'Experiencias reales'
        ];
        return data_get($titles, $locale, '');
    }

    public function about_point_1_text($locale): string
    {
        $texts = [
            'en' => 'From everyday life around pregnancy, baby time and family life.',
            'de' => 'Aus dem Alltag rund um Schwangerschaft, Babyzeit und Familienleben.',
            'fr' => 'Du quotidien autour de la grossesse, de la période de bébé et de la vie de famille.',
            'es' => 'De la vida cotidiana en torno al embarazo, la época del bebé y la vida familiar.'
        ];
        return data_get($texts, $locale, '');
    }

    public function about_point_2_title($locale): string
    {
        $titles = [
            'en' => 'Calm Classification',
            'de' => 'Ruhige Einordnung',
            'fr' => 'Classification calme',
            'es' => 'Clasificación tranquila'
        ];
        return data_get($titles, $locale, '');
    }

    public function about_point_2_text($locale): string
    {
        $texts = [
            'en' => 'Thoughts and observations, without making things bigger than they are.',
            'de' => 'Gedanken und Beobachtungen, ohne Dinge größer zu machen, als sie sind.',
            'fr' => 'Pensées et observations, sans rendre les choses plus grandes qu\'elles ne le sont.',
            'es' => 'Pensamientos y observaciones, sin hacer las cosas más grandes de lo que son.'
        ];
        return data_get($texts, $locale, '');
    }

    public function about_point_3_title($locale): string
    {
        $titles = [
            'en' => 'Without Advice Tone',
            'de' => 'Ohne Ratgeberton',
            'fr' => 'Sans ton de conseil',
            'es' => 'Sin tono de consejo'
        ];
        return data_get($titles, $locale, '');
    }

    public function about_point_3_text($locale): string
    {
        $texts = [
            'en' => 'No checklists, no quick solutions, no pressure.',
            'de' => 'Keine Checklisten, keine schnellen Lösungen, kein Druck.',
            'fr' => 'Pas de listes de contrôle, pas de solutions rapides, pas de pression.',
            'es' => 'Sin listas de verificación, sin soluciones rápidas, sin presión.'
        ];
        return data_get($texts, $locale, '');
    }
}
