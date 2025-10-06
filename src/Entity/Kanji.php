<?php
namespace App\Entity;

class Kanji {
    public function __construct(
        private string $kanji,
        private int $strokeCount,
        private string $onyomi,
        private string $kunyomi
    ) {}

    public function getKanji(): string { return $this->kanji; }
    public function getStrokeCount(): int { return $this->strokeCount; }
    public function getOnyomi(): string { return $this->onyomi; }
    public function getKunyomi(): string { return $this->kunyomi; }
}
