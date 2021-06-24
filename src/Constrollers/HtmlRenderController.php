<?php


namespace Api\Constrollers;


class HtmlRenderController
{
    public function renderHtml(string $caminhoTemplate, array $dados): string
    {
        extract($dados);
        ob_start();
        require __DIR__ . '/../Templates' . $caminhoTemplate;
        $html = ob_get_clean();
        return $html;
    }
}
