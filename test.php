<?php

function view($template, $data)
{
    $filename = __TEMPLATE_DIR__ . "/{$template}.template.php";
    if (!file_exists($filename)) {
        return '';
    }
    ob_start();
    extract($data);
    /** @noinspection PhpIncludeInspection */
    require $filename;
    $content = ob_get_contents();
    if ($content) {
        ob_end_clean();
    }
    return $content;
}

define('__TEMPLATE_DIR__', '....');

echo view('index', ['title' => 'Awesome', 'name' => 'William']);