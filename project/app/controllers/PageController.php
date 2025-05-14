<?php


namespace app\controllers;


use app\models\Page;
use Exception;
use wfm\App;

/** @property Page $model */
class PageController extends AppController
{

    public function viewAction()
    {
        $lang = App::$app->getProperty('language');
        $page = $this->model->get_page($this->route['slug'], $lang);

        if (!$page) {
            throw new Exception("Stranka nenalezena", 404);
            return;
        }

        $this->setMeta($page['title'], $page['description'], $page['keywords']);
        $this->set(compact('page'));
    }

}