<?php
namespace App\Controller;

use App\Repository\KanjiRepository;
use App\Service\NameAnalysisService;
use Smarty\Smarty;
use App\Helper\ViewHelper;

class ResultController {
    public function show(): void {
        $name     = $_POST['name'] ?? '';
        $gender   = $_POST['gender'] ?? '';
        $furigana = $_POST['furigana'] ?? ''; // 入力済みなら保持

        $repo = new KanjiRepository();
        $service = new NameAnalysisService($repo);
        $analysis = $service->analyze($name, $gender); // tenkaku系の数値/結果など一式が入る

        // 表示用クラス（色分け）
        $classMap = [
            '最大吉' => 'result-max',
            '大吉'   => 'result-great',
            '吉'     => 'result-good',
        ];

        // SP/PC 共通で回せる “表示用の行データ” を作る
        $rows = [
            [
                'label'  => '天格',
                'count'  => (int)$analysis['tenkaku'],
                'result' => (string)$analysis['tenkaku_result'],
                'class'  => $classMap[$analysis['tenkaku_result']] ?? 'result-other',
            ],
            [
                'label'  => '人格',
                'count'  => (int)$analysis['jingaku'],
                'result' => (string)$analysis['jingaku_result'],
                'class'  => $classMap[$analysis['jingaku_result']] ?? 'result-other',
            ],
            [
                'label'  => '地格',
                'count'  => (int)$analysis['chikaku'],
                'result' => (string)$analysis['chikaku_result'],
                'class'  => $classMap[$analysis['chikaku_result']] ?? 'result-other',
            ],
            [
                'label'  => '外格',
                'count'  => (int)$analysis['gaikaku'],
                'result' => (string)$analysis['gaikaku_result'],
                'class'  => $classMap[$analysis['gaikaku_result']] ?? 'result-other',
            ],
            [
                'label'  => '総格',
                'count'  => (int)$analysis['soukaku'],
                'result' => (string)$analysis['soukaku_result'],
                'class'  => $classMap[$analysis['soukaku_result']] ?? 'result-other',
            ],
        ];

        $smarty = new Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../../templates/');
        $smarty->setCompileDir(__DIR__ . '/../../templates_c/');

        // そのまま使う個別値
        $smarty->assign('name', $analysis['name']);
        $smarty->assign('gender', $analysis['gender']);
        $smarty->assign('furigana', $furigana);

        // hidden で使うためにも個別値を渡しておく
        foreach ($analysis as $k => $v) {
            $smarty->assign($k, $v);
        }

        // 表示用の配列
        $smarty->assign('rows', $rows);

        // 端末に合わせて result / sp/result を自動切替
        $smarty->display(ViewHelper::pickTemplatePath('result'));
    }
}
