<?php
namespace SystemCtl\Action;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class KillallAction implements ActionInterface
{
    /** @var string */
    private $process;

    /**
     * @throws ProcessFailedException
     */
    public function execute(): void
    {
        $process = new Process(["killall",$this->process]);
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
    public function setProcess(string $process): void
    {
        $this->process = $process;
    }
}