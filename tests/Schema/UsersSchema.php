<?php
declare(strict_types=1);

namespace Phauthentic\Pagination\Test\Schema;

use PDO;

class UsersSchema implements SchemaInterface
{
    /**
     * @var string
     */
    private static $sql =
        "CREATE TABLE IF NOT EXISTS users (
            id INT(11),
            username VARCHAR(64),
            created TIMESTAMP,
            updated TIMESTAMP,
            PRIMARY KEY (id)
        );";

    /**
     * {@inheritDoc}
     */
    public static function create(PDO $pdo): void
    {
        $pdo->query(static::$sql);
    }
}
