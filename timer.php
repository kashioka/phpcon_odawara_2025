#!/usr/bin/env php
<?php

// スクリーンをクリア
echo "\033[2J\033[;H";

// 引数をチェック
if ($argc < 2 || !is_numeric($argv[1])) {
    echo "使い方: php timer.php [秒数]\n";
    exit(1);
}

$totalSeconds = (int)$argv[1];

// 300秒を超える場合はエラー終了
if ($totalSeconds > 300) {
    echo "エラー: 秒数は300以下で指定してください。\n";
    exit(1);
}

$barLength = 50;

for ($i = $totalSeconds; $i >= 0; $i--) {
    $minutes = floor($i / 60);
    $seconds = $i % 60;

    // 経過割合を計算
    $progress = ($totalSeconds - $i) / $totalSeconds;
    $filledLength = round($barLength * $progress);

    // プログレスバーを生成
    $bar = str_repeat('█', $filledLength) . str_repeat('-', $barLength - $filledLength);

    // 残り時間を表示
    printf("\r[%s] 残り時間 %02d:%02d", $bar, $minutes, $seconds);

    sleep(1);
}

// カウントダウン終了時の表示
echo "\n🎉 終了です！\n";
