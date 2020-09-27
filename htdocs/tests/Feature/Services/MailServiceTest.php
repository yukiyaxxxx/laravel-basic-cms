<?php

namespace Tests\Feature\Services;

use App\Mails\Inquiry\AdminMail;
use App\Mails\Inquiry\CustomerMail;
use App\Services\MailService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MailServiceTest extends TestCase
{
    protected $service;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->service = app()->make(MailService::class);
    }

    /**
     * 管理者メール送信テスト
     */
    public function testSendInquiryAdminMail()
    {
        \Mail::fake();

        $content = [
            'type'  => 'type',
            'name'  => 'name',
            'email' => 'email@example.com',
            'body'  => 'body',
        ];

        $this->service->sendInquiryAdminMail($content);

        \Mail::assertSent(AdminMail::class, 1);

        \Mail::assertSent(AdminMail::class, function ($mail) {
            return $mail->hasTo(config('env.admin_email'));
        });
    }


    /**
     * サンクスメール送信テスト
     */
    public function testSendInquiryCustomerMail()
    {
        \Mail::fake();

        $content = [
            'type'  => 'type',
            'name'  => 'name',
            'email' => 'email@example.com',
            'body'  => 'body',
        ];

        $this->service->sendInquiryCustomerMail('to@example.com', $content);

        \Mail::assertSent(CustomerMail::class, 1);

        \Mail::assertSent(CustomerMail::class, function ($mail) {
            return $mail->hasTo('to@example.com');
        });
    }



}