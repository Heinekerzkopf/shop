<?php


namespace app\controllers\admin;

use RedBeanPHP\R;

class CategoryController extends AppController
{

    public function indexAction()
    {
        $title = 'Kategorie';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title'));
    }

    public function deleteAction()
    {
        $id = get('id');
        $errors = '';
        $children = R::count('category', 'parent_id = ?', [$id]);
        $products = R::count('product', 'category_id = ?', [$id]);
        if ($children) {
            $errors .= 'Chyba! Tato kategorie obsahuje dcerine kategorie<br>';
        }
        if ($products) {
            $errors .= 'Chyba! Tato kategorie obsahuje nejake polozky<br>';
        }
        if ($errors) {
            $_SESSION['errors'] = $errors;
        } else {
            R::exec("DELETE FROM category WHERE id = ?", [$id]);
            R::exec("DELETE FROM category_description WHERE category_id = ?", [$id]);
            $_SESSION['success'] = 'Kategorie byla smazana';
        }
        redirect(ADMIN . '/category');
    }
    public function addAction()
    {
        if (!empty($_POST)) {
            if ($this->model->category_validate()) {
                if ($this->model->save_category()) {
                    $_SESSION['success'] = 'Kategorie byla uložena';
                    redirect(ADMIN . '/category');
                } else {
                    $_SESSION['errors'] = 'Chyba!';
                }
            }
            redirect(ADMIN . '/category/add');
        }
        $title = 'Nová Kategorie';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title'));
    }
}
