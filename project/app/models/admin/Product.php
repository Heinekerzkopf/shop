<?php


namespace app\models\admin;


use app\models\AppModel;
use RedBeanPHP\R;
use wfm\App;

class Product extends AppModel
{

    public function get_products($lang, $start, $perpage): array
    {
        return R::getAll("SELECT p.*, pd.title 
                        FROM product p 
                        JOIN product_description pd on p.id = pd.product_id 
                        WHERE pd.language_id = ? LIMIT $start, $perpage", [$lang['id']]);
    }

    public function product_validate(): bool
    {
        $errors = '';
        if (!is_numeric(post('price'))) {
            $errors .= "Cena musí mít číselnou hodnotu<br>";
        }
        if (!is_numeric(post('old_price'))) {
            $errors .= "Cena musí mít číselnou hodnotu<br>";
        }

        foreach ($_POST['product_description'] as $lang_id => $item) {
            $item['title'] = trim($item['title']);
            $item['excerpt'] = trim($item['excerpt']);
            if (empty($item['title'])) {
                $errors .= "Chybí název v záložce {$lang_id}<br>";
            }
            if (empty($item['excerpt'])) {
                $errors .= "Chybí stručný popis v záložce {$lang_id}<br>";
            }
        }

        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            return false;
        }
        return true;
    }

    public function save_product(): bool
    {
        $lang = App::$app->getProperty('language')['id'];
        R::begin();
        try {
            // product
            $product = R::dispense('product');
            $product->category_id = post('parent_id', 'i');
            $product->price = post('price', 'f');
            $product->old_price = post('old_price', 'f');
            $product->status = post('status') ? 1 : 0;
            $product->hit = post('hit') ? 1 : 0;
            $product->img = post('img') ?: NO_IMAGE;
            $product->is_download = post('is_download') ? 1 : 0;
            $product_id = R::store($product);

            $product->slug = AppModel::create_slug('product', 'slug', $_POST['product_description'][$lang]['title'], $product_id);
            R::store($product);

            // product_description
            foreach ($_POST['product_description'] as $lang_id => $item) {
                R::exec("INSERT INTO product_description (product_id, language_id, title, content, excerpt, keywords, description) VALUES (?,?,?,?,?,?,?)", [
                    $product_id,
                    $lang_id,
                    $item['title'],
                    $item['content'],
                    $item['excerpt'],
                    $item['keywords'],
                    $item['description'],
                ]);
            }

            // product_gallery if exists
            if (isset($_POST['gallery']) && is_array($_POST['gallery'])) {
                $sql = "INSERT INTO product_gallery (product_id, img) VALUES ";
                foreach ($_POST['gallery'] as $item) {
                    $sql .= "({$product_id}, ?),";
                }
                $sql = rtrim($sql, ',');
                R::exec($sql, $_POST['gallery']);
            }

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            $_SESSION['form_data'] = $_POST;
            return false;
        }
    }
}
