<?php


namespace app\controllers\admin;


class MainController extends AppController
{

    public function indexAction()
    {
        $title = 'Home Page';
        $this->setMeta('Admin :: Home Page');
        $this->set(compact('title'));
    }

}