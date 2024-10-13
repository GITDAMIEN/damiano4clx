<?php

namespace App\Exceptions\Loggers;

use Throwable;

class MyLogger
{
    public static function log(Throwable $th): void
    {
        $logDir = __DIR__ . '/../../../logs';

        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        $log_message = 'Timestamp: ' . time() . ' - Error: ' . $th->getMessage() . "\nStacktrace:\n" . $th->getTraceAsString();
        file_put_contents($logDir . '/log_' . time() . '.txt', $log_message . "\n", FILE_APPEND);
    }
}
