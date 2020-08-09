<?php
/**
 * .envファイルの追加config
 */
return [
    // 管理画面URLハッシュ
    'admin_url'          => env('ADMIN_URL', 'admin'),
    // 管理者メールアドレス
    'admin_email'          => env('ADMIN_EMAIL', 'admin@example.com'),
    // 強制SSL
    'force_ssl' => env('FORCE_SSL', false),
    // ベーシック認証
    'basic_auth' => env('BASIC_AUTH', false),
    'basic_auth_user' => env('BASIC_AUTH_USER', 'user'),
    'basic_auth_password' => env('BASIC_AUTH_PASSWORD', 'password'),
];
