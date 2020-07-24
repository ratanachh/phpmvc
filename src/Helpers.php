<?php
declare(strict_types=1);

namespace App;

function dd($messages)
{
    echo '<pre>';
    var_dump($messages);
    die();
}