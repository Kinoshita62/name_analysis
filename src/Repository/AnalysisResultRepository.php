<?php
namespace App\Repository;

use PDO;

class AnalysisResultRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function save(
        string $name,
        string $furigana,
        int $sex,
        int $tenkaku, string $tenkaku_result,
        int $jingaku, string $jingaku_result,
        int $chikaku, string $chikaku_result,
        int $gaikaku, string $gaikaku_result,
        int $soukaku, string $soukaku_result
    ): bool {
        $stmt = $this->pdo->prepare("
            INSERT INTO analysis_results 
            (name, furigana, sex, 
            tenkaku, tenkaku_result,
            jingaku, jingaku_result,
            chikaku, chikaku_result,
            gaikaku, gaikaku_result,
            soukaku, soukaku_result)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");


        return $stmt->execute([
            $name, $furigana, $sex,
            $tenkaku, $tenkaku_result,
            $jingaku, $jingaku_result,
            $chikaku, $chikaku_result,
            $gaikaku, $gaikaku_result,
            $soukaku, $soukaku_result
        ]);
    }

    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM analysis_results ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteById(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM analysis_results WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
