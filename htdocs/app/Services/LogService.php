<?php

namespace App\Services;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

/**
 * ログ保存サービス
 * ログファイルを分離する
 *
 * Class LogService
 * @package App\Services
 */
class LogService
{
    /**
     * @param string $level
     * @param string $message
     * @param string $channel
     * @param string $fileName
     * @param string $logName
     */
    public function log(string $level, string $message, string $channel, string $fileName, string $logName)
    {
        $now = \Carbon::now();

        $year = $now->format('Y');
        $month = $now->format('m');

        $path = storage_path("logs/{$channel}/{$year}-{$month}/{$fileName}.log");

        $logger = new Logger($logName);
        $logger->pushHandler(
            $handler = new RotatingFileHandler($path)
        );
        $handler->setFormatter(tap(new LineFormatter(null, null, true, true), function ($formatter) {
            $formatter->includeStacktraces();
        }));

        $logger->log($level, $message);
    }
}
