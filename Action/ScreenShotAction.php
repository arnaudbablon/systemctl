<?php
namespace SystemCtl\Action;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ScreenShotAction implements ActionInterface
{
    /** @var string */
    private $path;

    public function execute(): void
    {
        $process = new Process([]);
        $process->setCommandLine("shutter -f -o $this->path -e -n");
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    public function support(string $className): bool
    {
        return $className === self::class;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }
}