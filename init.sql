CREATE TABLE analysis_results (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  furigana VARCHAR(100) NOT NULL,
  sex INT NOT NULL,
  tenkaku INT NOT NULL,
  tenkaku_result VARCHAR(50) NOT NULL,
  jingaku INT NOT NULL,
  jingaku_result VARCHAR(50) NOT NULL,
  chikaku INT NOT NULL,
  chikaku_result VARCHAR(50) NOT NULL,
  gaikaku INT NOT NULL,
  gaikaku_result VARCHAR(50) NOT NULL,
  soukaku INT NOT NULL,
  soukaku_result VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE kanji_data (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kanji CHAR(1) NOT NULL,
  stroke_count INT NOT NULL,
  onyomi VARCHAR(255),
  kunyomi VARCHAR(255)
);