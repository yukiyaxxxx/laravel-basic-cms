<?php

namespace Tests\Feature\Requests;

use App\Http\Requests\InquiryRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InquiryRequestTest extends TestCase
{
    protected $request;
    protected $placeholder;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->request = new InquiryRequest();
        $this->placeholder = [
            'type'  => 'type1',
            'name'  => 'name',
            'email' => 'test@example.com',
            'body'  => 'body',
        ];
    }

    /**
     * 正常通過
     */
    public function testInquiryRequestSuccess()
    {
        $this->request->merge($this->placeholder);

        $validator = \Validator::make($this->request->all(), $this->request->rules());
        $result = $validator->passes();

        $this->assertTrue($result);
    }


    /**
     * @param $data
     * @param $expected
     * @dataProvider dataProviderType
     */
    public function testType($data, $expected)
    {
        $column = 'type';
        $this->placeholder[$column] = $data;

        $this->request->merge($this->placeholder);

        $validator = \Validator::make($this->request->all(), $this->request->rules());
        $result = $validator->passes();

        $this->assertEquals($expected, $result);
    }

    public function dataProviderType()
    {
        return [
            'type1'       => ['type1', true],
            'type2'       => ['type2', true],
            'type3'       => ['type3', true],
            'type4'       => ['type4', false],
            'null'        => [null, false],
            'null_string' => ['', false],
        ];
    }


    /**
     * @param $data
     * @param $expected
     * @dataProvider dataProviderName
     */
    public function testName($data, $expected)
    {
        $column = 'name';
        $this->placeholder[$column] = $data;

        $this->request->merge($this->placeholder);

        $validator = \Validator::make($this->request->all(), $this->request->rules());
        $result = $validator->passes();

        $this->assertEquals($expected, $result);
    }

    public function dataProviderName()
    {
        return [
            'type'        => ['type', true],
            'ax49'        => [str_repeat('a', 49), true],
            'ax50'        => [str_repeat('a', 50), true],
            'ax51'        => [str_repeat('a', 51), false],
            'null'        => [null, false],
            'null_string' => ['', false],
        ];
    }


    /**
     * @param $data
     * @param $expected
     * @dataProvider dataProviderBody
     */
    public function testBody($data, $expected)
    {
        $column = 'body';
        $this->placeholder[$column] = $data;

        $this->request->merge($this->placeholder);

        $validator = \Validator::make($this->request->all(), $this->request->rules());
        $result = $validator->passes();

        $this->assertEquals($expected, $result);
    }

    public function dataProviderBody()
    {
        return [
            'type'        => ['type', true],
            'ax49'        => [str_repeat('a', 9999), true],
            'ax50'        => [str_repeat('a', 10000), true],
            'ax51'        => [str_repeat('a', 10001), false],
            'null'        => [null, false],
            'null_string' => ['', false],
        ];
    }

    /**
     * @param $data
     * @param $expected
     * @dataProvider dataProviderEmail
     */
    public function testEmail($data, $expected)
    {
        $column = 'email';
        $this->placeholder[$column] = $data;

        $this->request->merge($this->placeholder);

        $validator = \Validator::make($this->request->all(), $this->request->rules());
        $result = $validator->passes();

        $this->assertEquals($expected, $result);
    }

    public function dataProviderEmail()
    {
        return [
            'test@example.com'   => ['test@example.com', true],
            'test.@example.com'  => ['test.@example.com', false],
            'tes..t@example.com' => ['tes..t@example.com', false],
            'null'               => [null, false],
            'null_string'        => ['', false],
        ];
    }
}