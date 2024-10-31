<?php

namespace IntegrationHelper\BaseConsoleCommandRunner\Model;

interface ConsoleCommandProcessInterface
{
    public function execute(array $args = []);

    public function getDescription(): string;

    public function getProcessName(): string;
}
