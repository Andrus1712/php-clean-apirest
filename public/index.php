<?php
require '../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

header("Content-Type: application/json");

require '../src/Infrastructure/Routes/web.php';

