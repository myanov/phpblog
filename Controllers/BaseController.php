<?php

namespace Controllers;

use core\Request;

abstract class BaseController
{
    protected $title;
    protected $content;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function render()
    {
        return $this->build('v_main', [
            'title' => $this->title,
            'content' => $this->content
        ]);
    }

    protected function redirect($uri = '')
    {
        header(sprintf('Location: %s%s', ROOT, $uri));
        die;
    }

    protected function build($template, array $params = [])
    {
        ob_start();
        extract($params);
        include_once __DIR__ . "/../Views/$template.php";
        return ob_get_clean();
    }
}