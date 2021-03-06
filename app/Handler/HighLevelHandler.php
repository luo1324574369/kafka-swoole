<?php

namespace App\Handler;

use Kafka\Api\HighLevel\ConsumerInterface;

class HighLevelHandler implements ConsumerInterface
{
    public function handler(string $topic, int $partition, int $offset, string $message)
    {
        echo '[--] Received a message that read:' . $message . PHP_EOL;
    }
}
