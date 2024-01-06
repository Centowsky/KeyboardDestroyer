<?php

class View {
    private $data = [];

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    public function __get($name) {
        return $this->data[$name];
    }

    public function render($template) {
        $templatePath = __DIR__ . '/../templates/' . $template . '.php';
        
        if (file_exists($templatePath)) {
            include $templatePath;
        } else {
            echo 'Template not found: ' . $template;
        }
    }
}
