<?php

namespace App\Core\Renderer;

interface RendererInterface
{
    /**
     * @param string $view
     * @param array  $params
     *
     * @return string
     */
    public function render(string $view, array $params = []): string;
}
