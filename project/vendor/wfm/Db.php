<?php

namespace wfm;

use Exception;
use RedBeanPHP\R;

class Db {
    use TSingleton; 

    /**
     * Konstruktor pro nastavení připojení k databázi.
     * - Načte konfigurační soubor pro připojení k databázi.
     * - Nastaví připojení k databázi pomocí RedBeanPHP.
     * - Zkontroluje připojení k databázi.
     * - Pokud připojení selže, vyhodí výjimku.
     * - Zamrzne strukturu databáze pro prevenci změn.
     * - Pokud je povoleno ladění (DEBUG), zapne se zobrazování SQL dotazů.
     */
    private function __construct()
    {
        // Načte konfigurační soubor pro databázi
        $db = require_once CONFIG . '/config_db.php';

        // Nastaví připojení k databázi pomocí RedBeanPHP
        R::setup($db['dsn'], $db['user'], $db['password']);

        // Zkontroluje připojení k databázi
        if (!R::testConnection()) {
            throw new Exception('No connection to database', 500);
        }

        // Zamrzne strukturu databáze pro prevenci změn
        R::freeze(false);

        // Pokud je povoleno ladění (DEBUG), zapne se zobrazování SQL dotazů
        if (DEBUG) {
            R::debug(true, 3);
        }
        R::ext('xdispense', function( $type ){
            return R::getRedBean()->dispense( $type );
        });
    }
}
