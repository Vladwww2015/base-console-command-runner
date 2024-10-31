<?php

namespace IntegrationHelper\BaseConsoleCommandRunner\Model;

interface ConsoleCommandAlgorithmInterface
{
    public function execute(object $commandProcess, array $args = []);

    public function getInstance(): string;
}
