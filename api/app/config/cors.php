<?php
return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // 許可されるHTTPメソッド
    'allowed_methods' => ['*'],

    // 許可されるホスト
    'allowed_origins' => ['http://localhost:3000'],

    // 許可されるホスト(正規表現による設定)
    'allowed_origins_patterns' => [],

    // 許可されるヘッダー設定
    'allowed_headers' => ['*'],

    // カスタムヘッダーを公開する
    'exposed_headers' => false,

    // CORSレスポンスのキャッシュ
    'max_age' => 0,

    // CORSによるHTTPセッション
    'supports_credentials' => true,
];