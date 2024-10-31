<?php

namespace IntegrationHelper\BaseConsoleCommandRunner\Model;

use Magento\Framework\App\State;
use Magento\Framework\Exception\LocalizedException;

/**
 *
 */
class ConsoleCommandRunner implements ConsoleCommandRunnerInterface
{
    /**
     * @var array
     */
    private array $algorithms = [];

    /**
     * @var array
     */
    private array $processes = [];

    /**
     * @param State $appState
     * @param array $algorithms
     * @param array $processes
     * @throws LocalizedException
     */
    public function __construct(
        protected State $appState,
        array $algorithms = [],
        array $processes = []
    ) {
        foreach ($processes as $process) {
            if(!$process instanceof ConsoleCommandProcessInterface) {
                throw new LocalizedException(__('Console Command Process must be implement %1', ConsoleCommandProcessInterface::class));
            }

            if(array_key_exists($process->getProcessName(), $this->processes)) {
                throw new LocalizedException(__('Console Command Process with name %1 exist in initialize data', $process->getProcessName()));
            }

            $this->processes[$process->getProcessName()] = $process;
        }

        foreach ($algorithms as $algorithm) {
            if(!$algorithm instanceof ConsoleCommandAlgorithmInterface) {
                throw new LocalizedException(__('Console Command Algorithm must be implement %1', ConsoleCommandAlgorithmInterface::class));
            }

            $this->algorithms[] = $algorithm;
        }
    }

    /**
     * @param string $processName
     * @param array $args
     * @return void
     * @throws LocalizedException
     */
    public function execute(string $processName, array $args = [])
    {
        if(!array_key_exists($processName, $this->processes)) {
            throw new LocalizedException(__('Console Command Process with name %1 exist', $processName));
        }

        /**
         * @var $process ConsoleCommandProcessInterface
         */
        $process = $this->processes[$processName];

        $this->_checkEnableInCurrentMode($process);

        /**
         * @var $algorithm ConsoleCommandAlgorithmInterface
         */
        foreach ($this->algorithms as $algorithm) {
            if(is_a($process, $algorithm->getInstance())) {
                $algorithm->execute($process, $args);
                break;
            }
        }
    }

    /**
     * @param ConsoleCommandProcessInterface $commandProcess
     * @return void
     * @throws LocalizedException
     */
    protected function _checkEnableInCurrentMode(ConsoleCommandProcessInterface $commandProcess)
    {
        $mode = $this->appState->getMode();
        switch ($mode) {
            case State::MODE_PRODUCTION:
                $result = $commandProcess instanceof EnableInProductionModeInterface;
                break;
            case State::MODE_DEVELOPER:
                $result = $commandProcess instanceof EnableInDeveloperModeInterface;
                break;
            case State::MODE_DEFAULT:
                $result = $commandProcess instanceof EnableInDefaultModeInterface;
                break;
            default:
                throw new LocalizedException(__('Console Command Process with name %1 must be implement one or more Mode Interface(s)', $commandProcess->getProcessName(), $mode));
        }

        if(!$result) {
            throw new LocalizedException(__('Console Command Process with name %1 not allowed for %2 mode', $commandProcess->getProcessName(), $mode));
        }
    }
}
