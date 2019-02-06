<?php
namespace SystemCtl;

use SystemCtl\Action\ClickAction;
use SystemCtl\Action\CopyAction;
use SystemCtl\Action\KeyAction;
use SystemCtl\Action\PasteAction;
use SystemCtl\Action\ScreenShotAction;
use SystemCtl\Action\ScrollAction;
use Psr\Container\ContainerInterface;

class Application
{
    /** @var ContainerInterface */
    protected $containerAction;

    public function __construct(ContainerInterface $containerAction)
    {
        $this->containerAction = $containerAction;
    }

    public function screenShot(string $path): void
    {
        $action = $this->containerAction->get(ScreenShotAction::class);
        $action->setPath($path);
        $action->execute();
    }

    public function click(int $x, int $y, $left = true): void
    {
        $action = $this->containerAction->get(ClickAction::class);
        $action->setX($x);
        $action->setY($y);
        $action->setLeft($left);
        $action->execute();
    }


    public function scroll(int $x, int $y): void
    {
        $action = $this->containerAction->get(ScrollAction::class);
        $action->setX($x);
        $action->setY($y);
        $action->execute();
    }

    public function copy(string $text): void
    {
        $action = $this->containerAction->get(CopyAction::class);
        $action->setText($text);
        $action->execute();
    }

    public function paste(): void
    {
        $action = $this->containerAction->get(PasteAction::class);
        $action->execute();
    }

    public function key(string $key): void
    {
        $action = $this->containerAction->get(KeyAction::class);
        $action->setKey($key);
        $action->execute();
    }

    public function sleep(int $second): void
    {
        sleep($second);
    }

    public function usleep(int $microsecond): void
    {
        usleep($microsecond);
    }
}