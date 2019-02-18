<?php
namespace SystemCtl\Action;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class KeyAction implements ActionInterface
{
    /** string */
    private $key;

    /**
     * @throws ProcessFailedException
     */
    public function execute()
    {
        $process = new Process(["xdotool", "key", $this->key]);
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
     * @param mixed $text
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }
}