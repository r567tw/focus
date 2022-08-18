<?php

namespace r567tw\phpmvc;


class View
{
    protected const DEFAULT_LAYOUT = 'main';
    public string $title = '';

    public function renderView($view, $params = [])
    {
        $layout = $this->layoutContent();
        $content = $this->renderOnlyView($view, $params);
        return str_replace("{{ content }}", $content, $layout);
    }

    public function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $param) {
            $$key = $param;
        }
        ob_start();
        include_once Application::$rootPath . "/views/{$view}.php";
        return ob_get_clean();
    }

    public function layoutContent()
    {
        $layout = self::DEFAULT_LAYOUT;
        if (isset(Application::$app->controller)) {
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$rootPath . "/views/layouts/{$layout}.php";
        return ob_get_clean();
    }
}
