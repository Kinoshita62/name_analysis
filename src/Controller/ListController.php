<?php
namespace App\Controller;

use App\Repository\AnalysisResultRepository;
use Smarty\Smarty;
use App\Helper\ViewHelper;

class ListController {
    public function index(): void {
        $repo = new AnalysisResultRepository();
        $results = $repo->findAll();

        $results_male = array_values(array_filter($results, fn($r) => $r['sex'] == 1));
        $results_female = array_values(array_filter($results, fn($r) => $r['sex'] == 2));

        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../templates/');
        $smarty->setCompileDir(__DIR__ . '/../../templates_c/');

        $smarty->assign('results_male', $results_male);
        $smarty->assign('results_female', $results_female);

        $smarty->display(ViewHelper::pickTemplatePath('list'));
    }
}
