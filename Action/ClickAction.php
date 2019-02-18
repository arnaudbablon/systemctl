<?php
namespace SystemCtl\Action;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ClickAction implements ActionInterface
{
    /** @var int */
    private $x;

    /** @var int */
    private $y;

    /** @var bool */
    private $left;


    /**
     * @throws ProcessFailedException
     */
    public function execute()
    {
        $process = new Process(['xdotool', 'mousemove', "$this->x", "$this->y"]);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        usleep(300000);
        $process = new Process(['xdotool', 'click', $this->left]);
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
     * @param int $x
     */
    public function setX(int $x): void
    {
        $this->x = $x;
    }

    /**
     * @param int $y
     */
    public function setY(int $y): void
    {
        $this->y = $y;
    }

    /**
     * @param bool $left
     */
    public function setLeft(bool $left): void
    {
        if ($left === true) {
            $this->left = 1;
        } else {
            $this->left = 3;
        }
    }
}