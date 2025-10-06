<?php
namespace App\Service;

use App\Repository\KanjiRepository;

class NameAnalysisService {
    public function __construct(private KanjiRepository $repo) {}

    public function analyze(string $name, string $gender): array {
        $chars = preg_split('//u', $name, -1, PREG_SPLIT_NO_EMPTY);

        $meiStrokes = [];
        foreach ($chars as $c) {
            $meiStrokes[] = $this->repo->getStrokeCount($c);
        }

        // 苗字（仮に固定値）
        $seiStrokes = [4, 3];

        // 計算（省略、既存 result.php のロジックを移植）
        $tenkaku = array_sum($seiStrokes);
        $jingaku = $seiStrokes[count($seiStrokes) - 1] + ($meiStrokes[0] ?? 0);
        $chikaku = array_sum($meiStrokes);
        if (count($meiStrokes) === 1) $chikaku++;
        $soukaku = $tenkaku + $chikaku;
        $gaikaku = $seiStrokes[0] + ($meiStrokes[1] ?? 1);

        // 判定表
        $fortuneTable = [
            1  => '大吉',  2  => '大凶',  3  => '大吉',  4  => '大凶',  5  => '大吉',
            6  => '最大吉',7  => '吉',    8  => '吉',    9  => '最大凶',10 => '最大凶',
            11 => '大吉',  12 => '大凶',  13 => '大吉',  14 => '凶',   15 => '最大吉',
            16 => '大吉',  17 => '吉',    18 => '吉',    19 => '最大凶',20 => '最大凶',
            21 => '大吉',  22 => '凶',    23 => '大吉',  24 => '最大吉',25 => '吉',
            26 => '凶',    27 => '凶',    28 => '凶',    29 => '大吉',  30 => '凶',
            31 => '最大吉',32 => '大吉',  33 => '大吉',  34 => '大凶',  35 => '吉',
            36 => '大凶',  37 => '大吉',  38 => '吉',    39 => '大吉',  40 => '大凶',
            41 => '大吉',  42 => '凶',    43 => '凶',    44 => '大凶',  45 => '大吉',
            46 => '凶',    47 => '最大吉',48 => '吉',    49 => '凶',    50 => '凶',
            51 => '凶',    52 => '大吉',  53 => '凶',    54 => '大凶',  55 => '凶',
            56 => '凶',    57 => '吉',    58 => '吉',    59 => '凶',    60 => '大凶',
            61 => '吉',    62 => '大凶',  63 => '最大吉',64 => '大凶',  65 => '大吉',
            66 => '大凶',  67 => '大吉',  68 => '大吉',  69 => '大凶',  70 => '大凶',
            71 => '吉',    72 => '凶',    73 => '吉',    74 => '凶',    75 => '吉',
            76 => '大凶',  77 => '吉',    78 => '吉',    79 => '大凶',  80 => '大凶',
        ];

        return [
            'name'   => $name,
            'gender' => $gender,
            'tenkaku' => $tenkaku,
            'tenkaku_result' => $fortuneTable[$tenkaku] ?? '不明',
            'jingaku' => $jingaku,
            'jingaku_result' => $fortuneTable[$jingaku] ?? '不明',
            'chikaku' => $chikaku,
            'chikaku_result' => $fortuneTable[$chikaku] ?? '不明',
            'soukaku' => $soukaku,
            'soukaku_result' => $fortuneTable[$soukaku] ?? '不明',
            'gaikaku' => $gaikaku,
            'gaikaku_result' => $fortuneTable[$gaikaku] ?? '不明',
        ];
    }
}
