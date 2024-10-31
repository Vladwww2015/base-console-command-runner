<?php

namespace IntegrationHelper\BaseConsoleCommandRunner\Model;

interface ConsoleCommandRunnerInterface
{
    public function execute(string $processName, array $args = []);
}
