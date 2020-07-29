<?php

namespace Tests\Feature\Controllers;

use App\Mails\Inquiry\AdminMail;
use App\Mails\Inquiry\CustomerMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InquiryControllerTest extends TestCase
{
    public function testForm()
    {
        $response = $this->get(route('inquiry.form'));
        $response->assertStatus(200);
    }

    public function testConfirm()
    {
        \Mail::fake();

        $params = [
            'type'       => 'type',
            'email'      => 'email@example.com',
            'name'       => 'name',
            'body'       => 'body',
            'actionType' => 'confirm' // 確認画面アクション
        ];

        // サンクスメール検証
        $response = $this->post(route('inquiry.post'), $params);
        $response->assertStatus(200);
        $response->assertSee(route('inquiry.post'));
    }

    public function testPost()
    {
        \Mail::fake();

        $params = [
            'type'       => 'type',
            'email'      => 'email@example.com',
            'name'       => 'name',
            'body'       => 'body',
            'actionType' => 'send' // 送信アクション
        ];

        // サンクスメール検証
        $response = $this->post(route('inquiry.post'), $params);
        $response->assertStatus(302);
        $response->assertRedirect(route('inquiry.thanks'));

        \Mail::assertSent(AdminMail::class, 1);
        \Mail::assertSent(AdminMail::class, function ($mail) {
            return $mail->hasTo(config('env.admin_email'));
        });

        // 管理者メール検証
        \Mail::assertSent(CustomerMail::class, 1);
        \Mail::assertSent(CustomerMail::class, function ($mail) {
            return $mail->hasTo('email@example.com');
        });
    }

    public function testThanks()
    {
        $response = $this->get(route('inquiry.thanks'));
        $response->assertStatus(200);
    }

}
