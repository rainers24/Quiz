<?php

namespace Quiz\Controllers;


class BaseController
{
    /*** @var $post */
    protected $post;
    /*** @var $get */
    protected $get;
    /*** @var $action */
    protected $action;

    public function handleCall(string $action)
    {
        $this->action = $action;
        $this->post = $_POST;
        $this->get = $_GET;

        $this->callAction($action);

    }

    private function callAction($action)
    {
        echo static::$action();
    }

    protected function render(string $view, array $variables = []): string
    {
        $viewFile = $this->resolveViewFile($view);
        if (file_exists($viewFile)) {
            extract($variables);
            ob_start();
            include "$viewFile";
            $output = ob_get_clean();
            return $output;

        }
        return '';
    }

    private function resolveViewFile($view)
    {
        return VIEW_DIR . "/$view.php";
    }



}