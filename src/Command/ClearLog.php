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
            ->setDescription('Очищает таблицу по условию')
            ->setHelp('Очишает таблицу по условию. Параметры задаются в conf.php')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $tables = require_once dirname(__DIR__, 2) . '/conf.php';

        foreach ($tables as $table) {
            $output->writeln("Идет очистка таблицы {$table['name']} по условию {$table['condition']}...");

            /** @var ClearService $clearService */
            $clearService = $this->container->get('clear');
            $clearService->clear($table);

            $output->writeln("Таблица {$table['name']} очищена...");
        }

        return 0;
    }
}