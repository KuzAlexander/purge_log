<?php

namespace Efko\PurgeLog\Command;

use Efko\PurgeLog\Service\ClearService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class ClearLog extends Command
{
    use ContainerAwareTrait;

    protected function configure()
    {
        $this
            ->setName('clear')
            ->setDescription('Очищает логи')
            ->setHelp('Очишает выбранную таблицу')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var ClearService $clearService */
        $clearService = $this->container->get('clear');
        $statusSpaces = $clearService->clear();

        $output->writeln("Событие test $statusSpaces");

        return 0;
    }
}