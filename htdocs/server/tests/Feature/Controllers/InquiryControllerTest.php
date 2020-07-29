<?php

namespace Tests\Feature\Controllers;

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

    public function testPost()
    {
        $this->markTestIncomplete('TODO:');
    }

    public function testThanks()
    {
        $response = $this->get(route('inquiry.thanks'));
        $response->assertStatus(200);
    }

}
