<?php
namespace App\Controller;

use Smarty\Smarty;

class HomeController {
    public function index(): void {
        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../templates/');
        $smarty->setCompileDir(__DIR__ . '/../../templates_c/');
        $smarty->display('index.tpl'); // フォーム画面
    }
}
