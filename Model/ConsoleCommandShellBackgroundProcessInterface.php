<?php

namespace IntegrationHelper\BaseConsoleCommandRunner\Model;

interface ConsoleCommandShellBackgroundProcessInterface extends ConsoleCommandProcessInterface
{
    public function getConsoleCommand(): string;
}
