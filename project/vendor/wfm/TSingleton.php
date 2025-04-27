<?php

namespace wfm;

/**
 * Tento trait implementuje Singleton pattern, který zajišťuje, že třída bude mít pouze jednu instanci.
 */
trait TSingleton
{
    private static ?self $instance = null;

    /**
     * Získá instanci třídy (Singleton).
     * Pokud instance ještě neexistuje, vytvoří ji a vrátí ji.
     * 
     * @return static Instance třídy.
     */
    public static function getInstance(): static {
        return static::$instance ?? static::$instance = new static();
    }
}
