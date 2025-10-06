<?php
namespace App\Controller;

use App\Repository\AnalysisResultRepository;

class SaveController {
    public function save(): void {
        $name     = $_POST['name']     ?? '';
        $furigana = $_POST['furigana'] ?? '';
        $gender   = $_POST['gender']   ?? '';

        $tenkaku        = $_POST['tenkaku'] ?? 0;
        $tenkaku_result = $_POST['tenkaku_result'] ?? '';
        $jingaku        = $_POST['jingaku'] ?? 0;
        $jingaku_result = $_POST['jingaku_result'] ?? '';
        $chikaku        = $_POST['chikaku'] ?? 0;
        $chikaku_result = $_POST['chikaku_result'] ?? '';
        $gaikaku        = $_POST['gaikaku'] ?? 0;
        $gaikaku_result = $_POST['gaikaku_result'] ?? '';
        $soukaku        = $_POST['soukaku'] ?? 0;
        $soukaku_result = $_POST['soukaku_result'] ?? '';

        $sex = ($gender === 'male') ? 1 : 2;

        $repo = new AnalysisResultRepository();
        $success = $repo->save(
            $name, $furigana, $sex,
            $tenkaku, $tenkaku_result,
            $jingaku, $jingaku_result,
            $chikaku, $chikaku_result,
            $gaikaku, $gaikaku_result,
            $soukaku, $soukaku_result
        );

        if ($success) {
            header("Location: /index");
            exit;
        } else {
            echo "<h1>保存に失敗しました</h1>";
        }
    }
}
