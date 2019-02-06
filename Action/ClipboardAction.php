<?php
namespace SystemCtl\Action;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ClipboardAction implements ActionInterface
{
    /** string */
    private $text;

    public function execute(): void
    {
        $process = new Process([]);
        $process->setCommandLine("echo $this->text | xclip -selection c > /dev/null 2>&1");
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
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }
}