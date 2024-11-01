<?php

namespace SFAL\Core\Foundation\Contracts\Database;

interface SfalMigrationsInterface
{
    public static function execute($connection);
}