<?php

namespace Tests\Feature\Tools;

use Illuminate\Support\Facades\Http;
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
        Http::fake([
            '*' => Http::response([], 200, [
                'Cache-Control' => 'public, max-age=1800',
                'Content-Type' => 'text/html; charset=UTF-8',
            ]),
        ]);

        $response = $this->get(route($this->routeName, $params));
        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll(['status', 'data', 'message', 'code'])
                ->where('status', 'success')
                ->whereType('data.resultHtml', 'string')
                ->where('message', '')
                ->where('code', 200)
        );
    }

    /**
     * @dataProvider runIncorrectDataProvider
     * @return void
     */
    public function testRunWithIncorrectParams($params)
    {
        $response = $this->get(route($this->routeName, $params));
        $response->assertServerError();
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
            'google_with_slash' => [
                [
                    'url' => 'google.com/company',
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
