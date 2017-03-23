<?php

namespace App\Service;

class View
{
    // constants are provided from an include
    // TODO: consider refactor the config

    private $template;
    private $view_name;
    private $data;
    private $content;

    public function __construct(string $view_name, string $template = null)
    {
        $this->view_name = $view_name;
        $this->template = $template ?? 'template';
        $this->data = [];
    }

    public function data(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function render()
    {
        ob_start();

        // get and evaluate content of the partial
        extract($this->data);
        include '../templates/' . $this->view_name . '.tpl.php';
        $content = ob_get_contents();

        ob_clean();

        // render content inside the main template
        include '../templates/' . $this->template . '.tpl.php';
        $this->content = ob_get_contents();

        ob_end_clean();

        return $this->content;
    }
}