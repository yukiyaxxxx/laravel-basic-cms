<?php


/**
 * 配列をエスケープしながらURLエンコードせずにjson化
 * 文字列でも使用可
 *
 * @param [type] $array
 * @return void
 */
//if (! function_exists('vueEscape')) {
// function vueEscape($array)
// {
//     if (null != $array) {
//         $tempString = json_encode($array, JSON_UNESCAPED_UNICODE);
//         $tempString = str_replace('\r\n', '\n', $tempString);// 改行を統一
//         return $tempString;
//     } else {
//         if (is_array($array)) {
//             return '[]';
//         } else {
//             return '\'\'';
//         }
//     }
// }
//}


/**
 * 現在のGETクエリーを文字列化
 *
 * @return void
 */
//if (! function_exists('getHttpQuery')) {
// function getHttpQuery() {
//     if (null != http_build_query(Request::query())) {
//         return '?' . http_build_query(Request::query());
//     } else {
//         return null;
//     }
// }
//}

/**
 * メールアドレスを@以降伏字にする
 *
 * @param [type] $mail
 * @return void
 */
//if (! function_exists('fakeMail')) {
// function fakeMail($mail) {
//     if (1 == mb_substr_count($mail, '@')) {
//         $arr = explode('@', $mail);
//         return $arr[0] . '@' . str_repeat('*', strlen($arr[1]));
//     } else {
//         throw new Exception('error:fakeMail');
//     }
// }
//}


/**
 * 現在の言語設定を取得する
 *
 * @return string
 */
//if (! function_exists('getLocale')) {
//function getLocale()
//{
//    return \App::getLocale();
//}
//}


/**
 * baseディレクトリを設定
 * @return string
 */
//if (! function_exists('baseDirectory')) {
//function baseDirectory()
//{
//    return '';
//    return '/test';
//}

/**
 * 現在の言語設定に合わせてリンク用プレフィックスを生成する
 * @return null|string
 */
//if (! function_exists('baseUrl')) {
//function baseUrl()
//{
//    return baseDirectory();
//}
//}

/**
 * 現在の言語設定に合わせてリンク用プレフィックスを生成する(管理画面)
 * @return null|string
 */
//if (! function_exists('adminBaseUrl')) {
//    function adminBaseUrl()
//    {
//
//        return baseDirectory() . '/' . config('app.admin_url');
//    }
//}


/**
 * 言語切り替え用・言語設定部分以外のuriを取得
 * @return string
 */
//if (! function_exists('adminUri')) {
//function adminUri()
//{
//    return (string)str_replace(adminBaseUrl(), '', Request::url());
////    return (string)str_replace(adminBaseUrl(), '', '/' . Request::path());
//}
//}

/**
 * 配列をエスケープしながらURLエンコードせずにjson化
 * 文字列でも使用可
 *
 * @param [type] $array
 * @return void
 */
if (!function_exists('vueEscape')) {
    function vueEscape($array)
    {
        if (null != $array) {
            $tempString = json_encode($array, JSON_UNESCAPED_UNICODE);
            $tempString = str_replace('\r\n', '\n', $tempString);// 改行を統一
            return $tempString;
        } else {
            if (is_array($array)) {
                return '[]';
            } else {
                return '\'\'';
            }
        }
    }
}

/**
 * json形式かどうか調べる
 *
 * @param [type] $string
 * @return boolean
 */
if (!function_exists('isJson')) {
    function isJson($string)
    {
        if (is_string($string)
            && is_array(json_decode($string, true))
            && json_last_error() === JSON_ERROR_NONE) {
            return true;
        } else {
            return false;
        }
    }
}


/**
 * 日付け整形
 * @param $date
 * @param string $format
 * @return mixed
 */
if (!function_exists('dateFormat')) {
    function dateFormat($date, $format = 'Y年m月d日 H時i分')
    {
        if (isset($date)) {
            return \Carbon\Carbon::parse($date)->format($format);
        }
    }
}


/**
 * 日付け整形
 * @param $date
 * @param string $format
 * @param bool $isWeekJapanese
 * @return mixed
 */
//if (! function_exists('dateFormat')) {
//    function dateFormat($date, $format = 'Y年m月d日 H時i分', $isWeekJapanese = false)
//    {
//        if (isset($date)) {
//
//            $string = \Carbon\Carbon::parse($date)->format($format);
//
//            /**
//             * 曜日を日本語に置き換える（D）
//             * 注:文字列に曜日アルファベットを含むと変換されてしまう。
//             */
//            if (true == $isWeekJapanese) {
//                $weeks = [
//                    'Sun' => '日',
//                    'Mon' => '月',
//                    'Tue' => '火',
//                    'Wed' => '水',
//                    'Thu' => '木',
//                    'Fri' => '金',
//                    'Sat' => '土',
//                ];
//                foreach ($weeks as $key => $value) {
//                    $string = str_replace($key, $value, $string);
//                }
//            }
//
//            return $string;
//        }
//    }
//}

/**
 * ユニークID作成
 * @return string
 */
if (!function_exists('getUid')) {
    function getUid(): string
    {
        return uniqid((string)rand());
    }
}

/**
 * ルート一致判定・ワイルドカード、配列も使用可能
 * @param array|string $pattern
 * @return bool
 */
if (!function_exists('isCurrentRoute')) {
    function isCurrentRoute($pattern)
    {
        if (is_array($pattern)) {
            // 配列の場合
            foreach ($pattern as $p) {
                if (str_is($p, \Route::currentRouteName())) {
                    return true;
                }
            }
            return false;
        } else {
            // 文字列の場合
            return str_is($pattern, \Route::currentRouteName());
        }
    }
}


/**
 * ベーシック認証
 */
if (!function_exists('httpBasicAuth')) {
    function httpBasicAuth($name, $password, $realm = 'Protected area')
    {
        if (
            !isset($_SERVER['PHP_AUTH_USER'])
            || !($name == $_SERVER['PHP_AUTH_USER'] && $password == $_SERVER['PHP_AUTH_PW'])
        ) {
            header('WWW-Authenticate: Basic realm="' . $realm . '"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Not Allowed to access.';
            exit;
        }
    }
}


/**
 * envの配列版
 * カンマ区切りで.envに記述する
 */
if (!function_exists('envArray')) {
    function envArray($key)
    {
        if (null != env($key)) {
            return array_map('trim', explode(',', env($key)));
        }
    }
}

/**
 * 文字列を数字だけにして返す
 */
// if (!function_exists('numberOnlyFilter')) {
//     function numberOnlyFilter($string)
//     {
//         return preg_replace('/[^0-9]/', '', $string);
//     }
// }
