<?php
namespace SystemCtl\Action;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CopyAction implements ActionInterface
{
    /**
     * @throws ProcessFailedException
     */
    public function execute()
    {
        $process = new Process(["xdotool", "key", "ctrl+c"]);
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
}