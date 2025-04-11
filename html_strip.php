#!/usr/bin/env php
<?php
/**
 * HTMLファイルからタグを除去するスクリプト
 *
 * 使用方法: php html_strip.php [HTMLファイル名]
 * 例: php html_strip.php sample.html
 */

// コマンドライン引数のチェック
if ($argc < 2) {
    echo "使用方法: php html_strip.php [HTMLファイル名]\n";
    exit(1);
}

$filename = $argv[1];

// ファイルの存在確認
if (!file_exists($filename)) {
    echo "エラー: ファイル '$filename' が見つかりません。\n";
    exit(1);
}

// HTMLファイルを全体読み込みし、strip_tags() で全てのHTMLタグを除去
$content = file_get_contents($filename);
$text = strip_tags($content);
echo $text;
