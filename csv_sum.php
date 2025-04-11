#!/usr/bin/env php
<?php
/**
 * CSVファイルの合計を計算するスクリプト
 *
 * 使用方法: php csv_sum.php [CSVファイル名]
 * 例: php csv_sum.php data.csv
 */

// コマンドライン引数のチェック
if ($argc < 2) {
    echo "使用方法: php csv_sum.php [CSVファイル名]\n";
    exit(1);
}

$filename = $argv[1];

// ファイルの存在確認
if (!file_exists($filename)) {
    echo "エラー: ファイル '$filename' が見つかりません。\n";
    exit(1);
}

// CSVファイルを読み込む
$data = array_map('str_getcsv', file($filename));

// 先頭行（ヘッダー）を削除
array_shift($data);

// 2列目（index=1）の値を抽出し、合計を算出
$sum = array_sum(array_column($data, 1));
echo "合計: $sum\n";
