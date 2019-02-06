<?php
namespace SystemCtl\Action;

class ClickAction implements ActionInterface
{
    /** @var int */
    private $x;

    /** @var int */
    private $y;

    /** @var bool */
    private $left;

    public function execute(): void
    {
        exec("xdotool mousemove $this->x $this->y");
        usleep(300000);
        exec('xdotool click $this->left');
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