<?php
namespace SystemCtl\Action;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ScrollAction implements ActionInterface
{
    /** @var int */
    private $x;

    /** @var int */
    private $y;

    /**
     * @throws ProcessFailedException
     */
    public function execute(): void
    {
        $processMove = new Process(['xdotool', 'mousemove', "$this->x", "$this->y"]);
        $processClick = new Process(['xdotool', 'click', '1']);

        for ($i=0; $i<15; $i++) {
            $processMove->run();
            if (!$processMove->isSuccessful()) {
                throw new ProcessFailedException($processMove);
            }

            $processClick->run();
            if (!$processClick->isSuccessful()) {
                throw new ProcessFailedException($processClick);
            }

            usleep(500);
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
}