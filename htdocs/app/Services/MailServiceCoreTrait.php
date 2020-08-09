<?php

namespace App\Services;

use App\Services\LogService;
use Illuminate\Support\Str;

/**
 * メール送信サービスのコア部分
 * Class MailService
 * @package App\Services
 */
trait MailServiceCoreTrait
{
    protected $logService;

    // 送信回数
    public $sendCounter;

    // 送信間隔・何通に一回。インスタンス化するとリセットされる点に注意。
    public $sendIntervalTimes = 20;

    // 送信間隔・何秒スリープ
    public $sendIntervalSecond = 1;

    protected $mailDirectory = 'App\\Mail\\';

    /**
     * MailService constructor.
     * @param \App\Services\LogService $logService
     */
    public function __construct(LogService $logService)
    {
        //インスタンス化する際に送信回数を初期化
        $this->sendCounter = 0;

        // ログ保存サービスを使用する
        $this->logService = $logService;
    }

    /**
     * ログを残しながらメール送信
     * @param array|string $to
     * @param $content
     * @param $class
     * @param $attachFile
     * @param $attachFileOption
     * @throws \Exception
     */
    public function send($to, $content, $class, string $attachFile = null, array $attachFileOption = [])
    {
        if (null == $to) {
            throw new \Exception('送信先メールアドレスが指定されていません。MailService::send');
        }

        // 配列化
        if (!is_array($to)) {
            $to = [$to];
        }

        foreach ($to as $t) {
            try {
                // NOTE: 添付ファイルは複数送信先に共通になっていることに注意
                $mail = new $class($content, $attachFile, $attachFileOption);
                \Mail::to($t)->send($mail);
                // メール送信時にロギング
                $this->logging(
                // 'success',
                    true,
                    $t,
                    request()->fullUrl(),
                    $class,
                    $attachFile,
                    $attachFileOption
                );

                // 送信回数加算
                $this->sendCounterCountUp();

                // 何回に１回スリープして送信制限を回避する
                $this->sendIntervalSleep();

                // ローカル用・mailtrapの制限回避
                if (config('mail.host') == 'smtp.mailtrap.io') {
                    sleep(3);
                }

            } catch (\Exception $e) {
                $this->logging(
                // 'error',
                    false,
                    $t,
                    request()->fullUrl(),
                    $class,
                    $attachFile,
                    $attachFileOption
                );
                throw $e;
            }
        }
    }

    /**
     * LogServiceを使うログ記録
     *
     * @param bool $status
     * @param string $to
     * @param string $route
     * @param string|null $class
     * @param string|null $attachFile
     * @param array $attachFileOption
     */
    public function logging(
        bool $status,
        string $to,
        string $route,
        string $class = null,
        string $attachFile = null,
        array $attachFileOption = []
    )
    {
        $attachFileOption = json_encode($attachFileOption);

        if (true == $status) {
            $status = 'info';
            $statusString = 'success';
        } else {
            $status = 'error';
            $statusString = 'fail';
        }

        $message = "Mail send $statusString. [to:{$to}|route:{$route}|class:{$class}|attachFile:{$attachFile}|attachFileOption:{$attachFileOption}]";

        // ログディレクトリ名をMailクラス名にする
        $logName = $this->getLoggingMailLogName($class);

        $this->logService->log($status, $message, 'mail', 'mail', $logName);
    }


    /**
     * メールのログ名を取得 Mailクラスのクラス名
     *
     * @param string $mailClassName
     * @return string
     */
    public function getLoggingMailLogName(string $mailClassName)
    {

        $class = str_replace($this->mailDirectory, '', $mailClassName);
        $tempClass = explode('\\', $class);
        $tempClass = array_map(function ($string) {
            return Str::kebab($string);
        }, $tempClass);

        return implode('.', $tempClass);
    }

    /**
     * 送信回数カウントアップ
     * 何回に１回スリープを判定するため
     */
    public function sendCounterCountUp()
    {
        $this->sendCounter++;
    }

    /**
     * 何回に１回スリープを実行
     * スリープ実行した時だけtrueを返す
     * @return boolean
     */
    public function sendIntervalSleep()
    {
        if (0 != $this->sendCounter
            && (0 == $this->sendCounter % $this->sendIntervalTimes)) {
            sleep($this->sendIntervalSecond);
            // スリープ時にログを残す
            \Log::info('MailService::sendIntervalSleep()');
            return true;
        } else {
            return false;
        }
    }

}
