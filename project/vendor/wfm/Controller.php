<?php

namespace wfm;

abstract class Controller 
{
    public array $data = [];
    public array $meta = ['title' => '', 'keywords' => '', 'description' => ''];
    public false|string $layout = '';
    public string $view = '';
    public object $model;

    /**
     * Konstruktor třídy Controller.
     * Tento konstruktor přijímá informace o směrování a inicializuje objekt.
     * 
     * @param array $route Informace o směrování (např. kontroler, akce).
     */
    public function __construct(public $route = [])
    {
        
    }

    /**
     * Načte model podle směrování a uloží ho do objektu.
     * Model je dynamicky generován na základě informací o kontroleru.
     */
    public function getModel() {
        $model = 'app\models\\' . $this->route['admin_prefix'] . $this->route['controller'];
        if (class_exists($model)) {
            $this->model = new $model();
        }
    }

    /**
     * Načte šablonu pro zobrazení a renderuje ji s daty.
     * Pokud není šablona nastavena, použije se akce z routy jako výchozí.
     */
    public function getView() {
        $this->view = $this->view ?: $this->route['action'];
        (new View($this->route, $this->layout, $this->view, $this->meta))->render($this->data);
    }

    /**
     * Nastaví data, která budou předána do šablony pro zobrazení.
     * 
     * @param array $data Data pro šablonu.
     */
    public function set($data) {
        $this->data = $data;
    }

    /**
     * Nastaví meta tagy pro stránku (title, description, keywords).
     * 
     * @param string $title Titulek stránky.
     * @param string $description Popis stránky.
     * @param string $keywords Klíčová slova pro SEO.
     */
    public function setMeta($title = '', $description = '', $keywords = '') {
        $this->meta = [
            'title' => $title, 
            'description' => $description, 
            'keywords' => $keywords
        ];
    }
}
