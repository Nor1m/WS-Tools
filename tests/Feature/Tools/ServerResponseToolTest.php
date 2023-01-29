<?php

namespace Tests\Feature\Tools;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ServerResponseToolTest extends TestCase
{
    private string $routeName;

    public function setUp(): void
    {
        parent::setUp();
        $this->routeName = 'tools.run.server_response';
    }

    /**
     * @dataProvider runCorrectDataProvider
     * @return void
     */
    public function testRunWithCorrectParams($params)
    {
        $response = $this->get(route($this->routeName, $params));
        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll(['status', 'data', 'message', 'code'])
                ->has('data.totalTime')->whereType('data.totalTime', 'double')
                ->has('data.primaryIp')->whereType('data.primaryIp', 'string')
                ->has('data.localIp')->whereType('data.localIp', 'string')
                ->has('data.contentType')->whereType('data.contentType', 'string')
                ->has('data.curlServerResponses')->whereType('data.curlServerResponses', 'array')
                ->has('data.curlServerResponses.0.url')->whereType('data.curlServerResponses.0.url', 'string')
                ->has('data.curlServerResponses.0.httpCode')->whereType('data.curlServerResponses.0.httpCode', 'integer')
                ->has('data.curlServerResponses.0.response')->whereType('data.curlServerResponses.0.response', 'string')
                ->has('data.curlServerResponses.0.totalTime')->whereType('data.curlServerResponses.0.totalTime', 'double')
        );
    }

    /**
     * @dataProvider runIncorrectDataProvider
     * @return void
     */
    public function testRunWithIncorrectParams($params)
    {
        $response = $this->get(route($this->routeName, $params));
        $response->assertStatus(500);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll(['status', 'data', 'message', 'code'])
            ->where('status', 'error')
            ->where('data', [])
            ->where('message', __('response.server_is_not_responding'))
            ->where('code', 500)
        );
    }

    public function runCorrectDataProvider(): array
    {
        return [
            'cyrillic' => [
                [
                    'url' => 'яндекс.рф',
                ],
            ],
            'cyrillic_with_params' => [
                [
                    'url' => 'яндекс.рф?q=test',
                ],
            ],
            'cyrillic_with_slash' => [
                [
                    'url' => 'яндекс.рф/company',
                ],
            ],
            'google_with_slash' => [
                [
                    'url' => 'google.com/company',
                ],
            ],
            'google_with_protocol_http' => [
                [
                    'url' => 'http://google.com',
                ],
            ],
            'google_with_protocol_https' => [
                [
                    'url' => 'https://google.com',
                ],
            ],
            'google_with_protocol_with_params' => [
                [
                    'url' => 'https://google.com?q=test',
                ],
            ],
        ];
    }

    public function runIncorrectDataProvider(): array
    {
        return [
            'simple_text' => [
                 [
                     'url' => 'test',
                 ]
            ],
            'wrong_url' => [
                 [
                     'url' => 'wrong.wrong',
                 ]
            ],
        ];
    }
}
