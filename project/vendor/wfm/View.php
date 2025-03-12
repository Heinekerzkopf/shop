<?php

namespace wfm;

use RedBeanPHP\R;
use Exception;

class View
{

    public string $content = '';

    public function __construct(
        public $route,
        public $layout = '',
        public $view = '',
        public $meta = [],
    ) {
        if (false !== $this->layout) {
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    public function render($data)
    {
        if (is_array($data)) {
            extract($data);
        }

        // admin\ => admin/
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        $view_file = APP . "/views/{$prefix}{$this->route['controller']}/{$this->view}.php";
        if (is_file($view_file)) {
            ob_start();
            require_once $view_file;
            $this->content = ob_get_clean();
        } else {
            throw new Exception("Not found view {$view_file}", 500);
        }

        if (false !== $this->layout) {
            $layout_file = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($layout_file)) {
                require_once $layout_file;
            } else {
                throw new Exception("Not found layout {$layout_file}", 500);
            }
        }
    }

    public function getMeta()
    {
        $out = '<title>' . h($this->meta['title']) . '</title>' . PHP_EOL;
        $out .= '<meta name="description" content="' . h($this->meta['description']) . '">' . PHP_EOL;
        $out .= '<meta name="keywords" content="' . h($this->meta['keywords']) . '">' . PHP_EOL;
        return $out;
    }

    public function getDbLogs()
    {
        if (DEBUG) {
            $logger = R::getDatabaseAdapter()->getDatabase()->getLogger();

            $logs = array_merge(
                $logger->grep('SELECT'),
                $logger->grep('INSERT'),
                $logger->grep('UPDATE'),
                $logger->grep('DELETE')
            );

            debug($logs);
        }
    }

    public function getPart($file, $data = null) {
        if (is_array($data)) {
            extract($data);
        }
        $file = APP . "/views/{$file}.php";
        if (is_file($file)) {
            require $file;
        } else {
            echo "File {$file} was not found";
        }
    }
}
