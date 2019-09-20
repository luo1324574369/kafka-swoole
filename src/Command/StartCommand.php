<?php
declare(strict_types=1);

namespace Kafka\Command;

use Kafka\Event\StartBeforeEvent;
use Kafka\Manager\MetadataManager;
use Kafka\Server\KafkaCServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartCommand extends Command
{
    protected static $defaultName = 'start';

    protected function configure()
    {
        $this
            ->setDescription('Start Kafka-Swoole')
            ->setHelp('This command allows Start Kafka-Swoole-Server...');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     * @throws \Kafka\Exception\InvalidEnvException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        dispatch(new StartBeforeEvent(), StartBeforeEvent::NAME);
        $metadataManager = new MetadataManager();
        $processNum = $metadataManager->calculationClientNum();
        KafkaCServer::getInstance()->setProcess($processNum)->start();
    }
}
