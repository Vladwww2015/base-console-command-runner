<?php
namespace IntegrationHelper\BaseConsoleCommandRunner\Console\Command;

use IntegrationHelper\BaseConsoleCommandRunner\Model\ConsoleCommandRunnerInterface;
use IntegrationHelper\BaseLogger\Logger\Logger;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Run extends Command
{
    public const COMMAND = 'integration-helper:run';

    public const PROCESS_NAME = 'process_name';

    /**
     * @param ConsoleCommandRunnerInterface $commandRunner
     * @param string|null $name
     */
    public function __construct(
        protected ConsoleCommandRunnerInterface $commandRunner,
        string $name = null
    ) {
        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName(self::COMMAND)
            ->setDescription('Simple Way For Run Bind Console Command')
            ->addOption(
                self::PROCESS_NAME,
                'pn',
                InputOption::VALUE_REQUIRED,
                'Process Name'
            );

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $processName = $input->getOption(self::PROCESS_NAME);

            $this->commandRunner->execute($processName);
            $result = Cli::RETURN_SUCCESS;
        } catch (\Exception $e) {
            Logger::log($e->getMessage(), 'base_console_command_runner_crit');
            $result = Cli::RETURN_FAILURE;
        }

        return $result;
    }
}
