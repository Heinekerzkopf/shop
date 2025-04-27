<?php

namespace app\controllers;

use wfm\App;

class LanguageController extends AppController
{

    public function changeAction()
    {
        $lang = get('lang', 's');
        if ($lang) {
            if (array_key_exists($lang, App::$app->getProperty('languages'))) {
                // cut base URL
                $url = trim(str_replace(PATH, '', $_SERVER['HTTP_REFERER']), '/');

                // cut on two parts; first part = prev language
                $url_parts = explode('/', $url, 2);

                // looking for first part in lang array
                if (array_key_exists($url_parts[0], App::$app->getProperty('languages'))) {
                    // first part => new language, if not base
                    if ($lang != App::$app->getProperty('language')['code']) {
                        $url_parts[0] = $lang;
                    } else {
                        // if it base lang => delete from url
                        array_shift($url_parts);
                    }
                } else {
                    // first part => new language, if not base
                    if ($lang != App::$app->getProperty('language')['code']) {
                        array_unshift($url_parts, $lang);
                    }
                }

                $url = PATH . '/' . implode('/', $url_parts);
                redirect($url);
            }
        }
        redirect();
    }
}
