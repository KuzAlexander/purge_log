<?php

namespace Efko\PurgeLog\Command;

use Efko\PurgeLog\Service\ClearService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
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
            ->setHelp('Очишает таблицу по условию. Параметры задаются в config.php')
            ->addArgument('path', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path = $input->getArgument('path');

        if (!file_exists($path)) {
            $output->writeln("Файла $path не существует");

            return 0;
        }

        $file = require $path;

        /** @var ClearService $clearService */
        $clearService = $this->container->get('clear');
        foreach ($file as $table) {
            $output->writeln("Идет очистка таблицы {$table['name']} по условию {$table['condition']}...");

            $clearService->clear($table);

            $output->writeln("Таблица {$table['name']} очищена...");
        }

        return 0;
    }
}