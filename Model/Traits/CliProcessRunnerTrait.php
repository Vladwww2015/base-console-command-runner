<?php

declare(strict_types=1);

namespace IntegrationHelper\BaseConsoleCommandRunner\Model\Traits;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\ShellInterface;
use Symfony\Component\Process\PhpExecutableFinder;

trait CliProcessRunnerTrait
{
    public function runCommand(string $command, array $arguments = []): void
    {
        $php = $this->getPhpExecutableFinder()->find() ?: 'php';
        $argument = $arguments ? ' %s' : '';
        $command = sprintf('%s %s/bin/magento %s', $php, BP, $command) . $argument;
        $this->getShell()->execute($command, $arguments);
    }

    protected function getPhpExecutableFinder()
    {
        return ObjectManager::getInstance()->get(PhpExecutableFinder::class);
    }

    protected function getShell(): ShellInterface
    {
        throw new \Exception('Implement this method');
    }
}
