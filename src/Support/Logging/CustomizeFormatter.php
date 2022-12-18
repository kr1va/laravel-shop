<?php

namespace Support\Logging;

use Monolog\Formatter\LineFormatter;

class CustomizeFormatter
{
    /**
     * Customize the given logger instance.
     *
     * @param \Illuminate\Log\Logger $logger
     * @return void
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(
                new LineFormatter(
                    "Дата:%datetime% \nКанал: %channel% \nУровень: %level_name% \nСообщение: %message% %context% %extra%",
                    'd.m.Y h:m:i',
                    true,
                    true,
                    true
                )
            );
        }
    }
}
