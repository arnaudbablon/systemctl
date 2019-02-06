<?php
namespace SystemCtl\Action;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CopyAction implements ActionInterface
{
    public function execute(): void
    {
        $process = new Process(["xdotool", "key", "ctrl+c"]);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    public function support(string $className): bool
    {
        return $className === self::class;
    }
}