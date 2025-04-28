<?php

namespace wfm;

class App 
{
    public static $app;

    /**
     * Konstruktor třídy, který inicializuje aplikaci.
     * - Načte parametr dotazu z URL.
     * - Vytvoří instanci ErrorHandleru pro správu chyb.
     * - Načte instanci Registry pro aplikaci.
     * - Načte parametry z konfiguračního souboru a uloží je.
     * - Provádí směrování požadavku na správnou akci.
     */
    public function __construct()
    {
        $query = trim(urldecode($_SERVER['QUERY_STRING']), '/');
        new ErrorHandler();
        session_start();
        self::$app = Registry::getInstance();
        $this->getParams();
        Router::dispatch($query);
    }

    /**
     * Načte parametry z konfiguračního souboru a nastaví je v aplikaci.
     */
    protected function getParams() {
        $params = require_once CONFIG . '/params.php';
        if (!empty($params)) {
            foreach ($params as $k => $v) {
                self::$app->setProperty($k, $v);
            }
        }
    }
}
