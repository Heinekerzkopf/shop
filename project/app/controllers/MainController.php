<?php

namespace app\controllers;

use RedBeanPHP\R;
use wfm\Controller;
use app\models\Main;

class MainController extends Controller
{

    public function indexAction()
    {
        $names = $this->model->get_names();
        $this->setMeta('Main page', 'description of the main page', 'keywords....');
        $this->set(compact('names'));
    }
}
