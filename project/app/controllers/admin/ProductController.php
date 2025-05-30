<?php


namespace app\controllers\admin;


use app\models\admin\Product;
use RedBeanPHP\R;
use wfm\App;
use wfm\Pagination;

/** @property Product $model */
class ProductController extends AppController
{

    public function indexAction()
    {
        $lang = App::$app->getProperty('language');
        $page = get('page');
        $perpage = 5;
        $total = R::count('product');
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $products = $this->model->get_products($lang, $start, $perpage);
        $title = 'Seznam produktů';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title', 'products', 'pagination', 'total'));
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            if ($this->model->product_validate()) {
                if ($this->model->save_product()) {
                    $_SESSION['success'] = 'Produkt byl přidán';
                } else {
                    $_SESSION['errors'] = 'Došlo k chybě';
                }
            }
            redirect();
        }

        $lang = App::$app->getProperty('language')['id'];

        $cats = R::getAll("
            SELECT c.id, c.parent_id, cd.title
            FROM category c
            JOIN category_description cd ON c.id = cd.category_id
            WHERE cd.language_id = ?
            ORDER BY c.parent_id, cd.title
        ", [$lang]);

        $options = $this->buildOptions($cats);

        $title = 'Nový produkt';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('options', 'title'));
    }

    protected function buildOptions(array $cats): array
    {
        $tree = [];
        foreach ($cats as $cat) {
            $depth = $this->depth($cat['parent_id'], $cats);
            $tree[$cat['id']] = str_repeat('-- ', $depth) . $cat['title'];
        }
        return $tree;
    }

    protected function depth($parentId, $all)
    {
        $d = 0;
        while ($parentId) {
            $parent = array_filter($all, fn($c) => $c['id'] == $parentId);
            $parent = reset($parent);
            $parentId = $parent['parent_id'] ?? null;
            $d++;
        }
        return $d;
    }

    public function editAction()
    {
        $id = get('id');

        if (!empty($_POST)) {
            if ($this->model->product_validate()) {
                if ($this->model->update_product($id)) {
                    $_SESSION['success'] = 'Produkt byl uložen';
                } else {
                    $_SESSION['errors'] = 'Chyba při uložení produktu';
                }
            }
            redirect();
        }

        $product = $this->model->get_product($id);
        if (!$product) {
            throw new \Exception('Not found product', 404);
        }

        $gallery = $this->model->get_gallery($id);

        $lang = App::$app->getProperty('language')['id'];
        App::$app->setProperty('parent_id', $product[$lang]['category_id']);
        $title = 'Úprava produktu';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title', 'product', 'gallery'));
    }

    public function getDownloadAction()
    {
        $q = get('q', 's');
        $downloads = $this->model->get_downloads($q);
        echo json_encode($downloads);
        die;
    }

    public function deleteAction()
    {
        $id = get('id', 'i');

        if (!$id) {
            throw new \Exception('Chybí ID produktu', 400);
        }

        if ($this->model->delete_product($id)) {
            $_SESSION['success'] = 'Produkt byl smazán';
        } else {
            $_SESSION['errors']  = 'Chyba při mazání produktu';
        }

        redirect(ADMIN . '/product');
    }
}
