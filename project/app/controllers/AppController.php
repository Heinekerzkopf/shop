<?php

namespace app\controllers;

use app\models\AppModel;
use app\widgets\language\Language;
use wfm\App;
use wfm\Controller;
use wfm\Language as WfmLanguage;

class AppController extends Controller
{
    public function __construct($route = [])
    {
        parent::__construct($route);
        new AppModel();

        App::$app->setProperty('languages', Language::getLanguages());
        App::$app->setProperty('language', Language::getLanguage(App::$app->getProperty('languages')));
        // debug(App::$app->getProperty('languages'));
        // debug(App::$app->getProperty('language'));

        $lang = App::$app->getProperty('language');
        WfmLanguage::load($lang['code'], $this->route);
        // debug(WfmLanguage::$lang_data);
    }
}