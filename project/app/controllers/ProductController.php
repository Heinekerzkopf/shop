<?php


namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Product;
use wfm\App;

/** @property Product $model */
class ProductController extends AppController
{

    public function viewAction()
    {
        $lang = App::$app->getProperty('language');
        $product = $this->model->get_product($this->route['slug'], $lang);

        if (!$product) {
            throw new \Exception("Zbozi {$this->route['slug']} nenalezeno", 404);
        }

        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product['category_id'], $product['title']);

        $gallery = $this->model->get_gallery($product['id']);
        $this->setMeta($product['title'], $product['description'], $product['keywords']);
        $this->set(compact('product', 'gallery', 'breadcrumbs'));

    }

}