<?php

namespace IntegrationHelper\BaseConsoleCommandRunner\Model;

use Magento\Framework\Exception\LocalizedException;

/**
 *
 */
class ConsoleCommandAlgorithmDefault implements ConsoleCommandAlgorithmInterface
{
    /**
     * @param object $commandProcess
     * @param array $args
     * @return void
     * @throws LocalizedException
     */
    public function execute(object $commandProcess, array $args = [])
    {
        if(!$commandProcess instanceof ConsoleCommandProcessInterface) {
            throw new LocalizedException(__('Command Process for Default Algorithm must be implement %1', ConsoleCommandProcessInterface::class));
        }

        $commandProcess->execute($args);
    }

    /**
     * @return string
     */
    public function getInstance(): string
    {
        return ConsoleCommandProcessInterface::class;
    }
}
