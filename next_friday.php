#!/usr/bin/env php
<?php
/**
 * 次の金曜日の日付を取得するスクリプト
 *
 * 使用方法: php next_friday.php
 */

// DateTime クラスと自然言語指定により、次の金曜日を簡単に取得
$nextFriday = new DateTime('next Friday');
echo "次の金曜日: " . $nextFriday->format('Y-m-d') . "\n";
