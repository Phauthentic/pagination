<?php
if (!getenv('PDO_DB_DSN')) {
    putenv('db_dsn=sqlite:///:memory:');
}
