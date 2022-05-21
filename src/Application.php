<?php

namespace Efko\PurgeLog;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Application extends \Symfony\Component\Console\Application
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container, $name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        $this->container = $container;
        parent::__construct($name, $version);
    }

    /**
     * {@inheritdoc}
     */
    public function add(Command $command)
    {
        $useCommandTraits = class_uses($command);

        if (in_array('Symfony\Component\DependencyInjection\ContainerAwareTrait', $useCommandTraits, true)) {
            /* @var ContainerAwareInterface $command */
            $command->setContainer($this->container);
        }

        return parent::add($command);
    }
}
