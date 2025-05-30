<?php

namespace app\controllers;

use app\models\Cart;
use wfm\App;

class LanguageController extends AppController
{

    public function changeAction()
    {
        $lang = get('lang', 's');
    
        if ($lang && array_key_exists($lang, App::$app->getProperty('languages'))) {
    
            // 1️⃣  – bezpečné načtení refereru
            $referer = $_SERVER['HTTP_REFERER'] ?? PATH . '/';
            // případně:
            // $referer = filter_input(INPUT_SERVER, 'HTTP_REFERER') ?: PATH . '/';
    
            // 2️⃣  – zbytek tvé logiky beze změny
            $url = trim(str_replace(PATH, '', $referer), '/');
            $url_parts = explode('/', $url, 2);
    
            if (array_key_exists($url_parts[0], App::$app->getProperty('languages'))) {
                if ($lang != App::$app->getProperty('language')['code']) {
                    $url_parts[0] = $lang;            // přepni prefix jazyka
                } else {
                    array_shift($url_parts);          // nebo prefix smaž
                }
            } else {
                if ($lang != App::$app->getProperty('language')['code']) {
                    array_unshift($url_parts, $lang); // přidej prefix jazyka
                }
            }
    
            Cart::translate_cart(App::$app->getProperty('languages')[$lang]);
    
            $url = PATH . '/' . implode('/', $url_parts);
            redirect($url);
        }
    
        // pokud nebyl lang nebo je neplatný
        redirect(PATH);
    }
    
}
