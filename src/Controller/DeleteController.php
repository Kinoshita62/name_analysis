<?php
namespace App\Controller;

use App\Repository\AnalysisResultRepository;

class DeleteController {
    public function delete(): void {
        $id = $_POST['id'] ?? null;

        if ($id === null) {
            echo "<h1>ID が指定されていません</h1>";
            return;
        }

        $repo = new AnalysisResultRepository();
        $success = $repo->deleteById((int)$id);

        if ($success) {
            header("Location: /list");
            exit;
        } else {
            echo "<h1>削除に失敗しました</h1>";
        }
    }
}
