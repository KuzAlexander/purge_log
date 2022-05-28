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
            ->addArgument('name', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $nameFile = $input->getArgument('name');

        $fullPath = dirname(__FILE__);
        $itemNumber = mb_strpos($fullPath, 'vendor');
        $pathToFile = substr($fullPath, 0, $itemNumber) . $nameFile;

        if (!file_exists($pathToFile)) {
            $output->writeln("Файла $pathToFile не существует");

            return 0;
        }

        $file = require $pathToFile;

        foreach ($file as $table) {
            $output->writeln("Идет очистка таблицы {$table['name']} по условию {$table['condition']}...");

            /** @var ClearService $clearService */
            $clearService = $this->container->get('clear');
            $clearService->clear($table);

            $output->writeln("Таблица {$table['name']} очищена...");
        }

        return 0;
    }
}