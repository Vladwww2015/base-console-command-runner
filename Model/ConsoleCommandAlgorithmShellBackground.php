<?php

namespace IntegrationHelper\BaseConsoleCommandRunner\Model;

use IntegrationHelper\BaseConsoleCommandRunner\Model\Traits\CliProcessRunnerTrait;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\ShellInterface;

class ConsoleCommandAlgorithmShellBackground implements ConsoleCommandAlgorithmInterface
{
    use CliProcessRunnerTrait;

    /**
     * @param ShellInterface $shell
     */
    public function __construct(
        protected ShellInterface $shell
    ){}

    /**
     * @param object $commandProcess
     * @param array $args
     * @return void
     * @throws LocalizedException
     */
    public function execute(object $commandProcess, array $args = [])
    {
        if(!$commandProcess instanceof ConsoleCommandShellBackgroundProcessInterface) {
            throw new LocalizedException(__('Command Process for Algorithm Shell Background must be implement %1', ConsoleCommandShellBackgroundProcessInterface::class));
        }

        $this->runCommand($commandProcess->getConsoleCommand(), $args);
    }

    /**
     * @return string
     */
    public function getInstance(): string
    {
        return ConsoleCommandShellBackgroundProcessInterface::class;
    }
}
