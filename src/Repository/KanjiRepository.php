<?php
namespace App\Repository;

use App\Entity\Kanji;
use PDO;

class KanjiRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function findByCondition(?string $strokeCount, ?string $reading): array {
        $sql = "SELECT kanji, stroke_count, onyomi, kunyomi FROM kanji_data WHERE 1=1";
        $params = [];

        if ($strokeCount !== '' && $strokeCount !== null) {
            $sql .= " AND stroke_count = ?";
            $params[] = $strokeCount;
        }
        if ($reading !== '' && $reading !== null) {
            $sql .= " AND (onyomi LIKE ? OR kunyomi LIKE ?)";
            $params[] = "%$reading%";
            $params[] = "%$reading%";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($r) => new Kanji(
            $r['kanji'],
            (int)$r['stroke_count'],
            $r['onyomi'],
            $r['kunyomi']
        ), $rows);
    }

    public function getStrokeCount(string $kanji): int {
        $stmt = $this->pdo->prepare("SELECT stroke_count FROM kanji_data WHERE kanji = ? LIMIT 1");
        $stmt->execute([$kanji]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? (int)$row['stroke_count'] : 0;
    }
}
