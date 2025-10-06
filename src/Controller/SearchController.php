<?php
namespace App\Controller;

use App\Repository\KanjiRepository;
use Smarty\Smarty;

class SearchController {
    public function search(): void {
        $strokeCount = $_GET['stroke_count'] ?? null;
        $reading     = $_GET['reading'] ?? null;

        $repo = new KanjiRepository();
        $results = $repo->findByCondition($strokeCount, $reading);

        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../templates/');
        $smarty->setCompileDir(__DIR__ . '/../../templates_c/');

        $smarty->assign('results', $results);
        $smarty->assign('stroke_count', $strokeCount);
        $smarty->assign('reading', $reading);

        $smarty->display('search.tpl');
    }
}
