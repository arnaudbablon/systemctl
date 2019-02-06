<?php
namespace SystemCtl\Action;

class ScrollAction implements ActionInterface
{
    /** @var int */
    private $x;

    /** @var int */
    private $y;

    public function execute(): void
    {
        for ($i=0; $i<15; $i++) {
            exec("xdotool mousemove $this->x $this->y");
            exec("xte 'mouseclick 1'");
            usleep(500);
        }
    }

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