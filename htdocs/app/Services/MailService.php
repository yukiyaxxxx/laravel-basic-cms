<?php

namespace App\Services;

use App\Mails\Inquiry\AdminMail;
use App\Mails\Inquiry\CustomerMail;
use App\Services\LogService;
use App\Services\MailServiceCoreTrait;
use Illuminate\Support\Str;

/**
 * メール送信サービス
 * Class MailService
 * @package App\Services
 */
class MailService
{
    use MailServiceCoreTrait;

    /**
     * 問い合わせ サンクスメール送信
     *
     * @param $to
     * @param $content
     * @throws \Exception
     */
    public function sendInquiryCustomerMail($to, $content)
    {
        $this->send($to, $content, CustomerMail::class);
    }

    /**
     * 問い合わせ 管理者メール送信
     *
     * @param $content
     * @throws \Exception
     */
    public function sendInquiryAdminMail($content)
    {
        $this->send(config('env.admin_email'), $content, AdminMail::class);
    }

}
