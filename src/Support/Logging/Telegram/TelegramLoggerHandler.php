<?php

namespace Support\Logging\Telegram;

use App\Exceptions\TelegramBotApiException;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Services\Telegram\TelegramBotApi;

class TelegramLoggerHandler extends AbstractProcessingHandler
{
    protected int $chat_id;
    protected string $token;

    public function __construct(array $config)
    {
        $level = Logger::toMonologLevel($config['level']);

        parent::__construct($level);

        $this->chat_id = (int)$config['chat_id'];
        $this->token = $config['token'];
    }

    protected function write(array $record): void
    {
        //$record['formatted']
        try {
            TelegramBotApi::sendMessage(
                $this->token,
                $this->chat_id,
                $record['formatted']
            );
        } catch (TelegramBotApiException $e) {
            dd($e);
        }
    }
}
