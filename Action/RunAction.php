<?php
namespace SystemCtl\Action;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class RunAction implements ActionInterface
{
    /** @var string */
    private $command;

    /**
     * @throws ProcessFailedException
     */
    public function execute()
    {

        $process = new Process([]);
        $process->setCommandLine("$this->command");
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    /**
     * @param string $className
     * @return bool
     */
    public function support(string $className): bool
    {
        return $className === self::class;
    }

    /**
     * @param string $command
     */
    public function setCommand(string $command): void
    {
        $this->command = $command;
    }
}