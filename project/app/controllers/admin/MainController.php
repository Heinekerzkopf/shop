<?php


namespace app\controllers\admin;

use RedBeanPHP\R;

class MainController extends AppController
{

    public function indexAction()
    {
        $orders = R::count('orders');
        $new_orders = R::count('orders', 'status = 0');
        $users = R::count('user');
        $products = R::count('product');

        $title = 'Home Page';
        $this->setMeta('Admin :: Home Page');
        $this->set(compact('title'));
        $this->set(compact('title', 'orders', 'new_orders', 'users', 'products'));
    }
}
