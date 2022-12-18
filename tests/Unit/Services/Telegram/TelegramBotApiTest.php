<?php

namespace Tests\Unit\Services\Telegram;

use Illuminate\Support\Facades\Http;
use Services\Telegram\TelegramBotApi;
use Tests\TestCase;


class TelegramBotApiTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function it_send_message_success_by_http_fake(): void
    {
        Http::fake([
            TelegramBotApi::HOST . '*' => Http::response(['ok' => true])
        ]);

        $result = TelegramBotApi::sendMessage('', 1, 'testing');

        $this->assertTrue($result);
    }
    /*
        public function it_send_message_success_by_fake_instance(): void
        {
            TelegramBotApi::fake()->returnTrue();
        }*/

}
