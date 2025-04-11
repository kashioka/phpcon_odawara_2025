#!/usr/bin/env php
<?php
/**
 * XMLからデータを読み込み、APIへPOSTするスクリプト
 *
 * 使用方法: php xml_to_api.php [XMLファイル名] [APIエンドポイント]
 * 例: php xml_to_api.php data.xml https://api.example.com/addItem
 */

// コマンドライン引数のチェック
if ($argc < 3) {
    echo "使用方法: php xml_to_api.php [XMLファイル名] [APIエンドポイント]\n";
    exit(1);
}

$filename = $argv[1];
$apiEndpoint = $argv[2];

// ファイルの存在確認
if (!file_exists($filename)) {
    echo "エラー: ファイル '$filename' が見つかりません。\n";
    exit(1);
}

// XMLファイルを読み込み、SimpleXMLでパースする
$xml = simplexml_load_file($filename);
if ($xml === false) {
    echo "エラー: XMLファイルの解析に失敗しました。\n";
    exit(1);
}

$items = [];
// 各アイテムを連想配列へ変換
foreach ($xml->item as $item) {
    $items[] = [
        'name'  => (string)$item->name,
        'price' => (int)$item->price,
    ];
}

// APIエンドポイントにJSON形式でデータをPOSTする
$data = json_encode($items);

$options = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-Type: application/json\r\n" .
            "Content-Length: " . strlen($data) . "\r\n",
        'content' => $data,
    ],
];

$context = stream_context_create($options);
$response = file_get_contents($apiEndpoint, false, $context);

if ($response === false) {
    echo "エラー: APIリクエストに失敗しました。\n";
    exit(1);
}

echo "API Response: $response\n";
