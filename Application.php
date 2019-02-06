<?php
namespace SystemCtl;

use Symfony\Component\Process\Exception\ProcessFailedException;
use SystemCtl\Action\ActionInterface;
use SystemCtl\Action\ClickAction;
use SystemCtl\Action\ClipboardAction;
use SystemCtl\Action\CopyAction;
use SystemCtl\Action\KeyAction;
use SystemCtl\Action\PasteAction;
use SystemCtl\Action\ScreenShotAction;
use SystemCtl\Action\ScrollAction;
use SystemCtl\Container\ActionContainer;
use SystemCtl\Container\ContainerInterface;

class Application
{
    /** @var ContainerInterface */
    protected $containerAction;

    /**
     * Application constructor.
     * @param ContainerInterface $containerAction
     */
    public function __construct(ContainerInterface $containerAction)
    {
        $this->containerAction = $containerAction;
    }

    /**
     * @param ActionInterface $action
     */
    public function execute(ActionInterface $action): void
    {
        try {
            $action->execute();
        } catch (ProcessFailedException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param string $path
     */
    public function screenShot(string $path): void
    {
        $action = $this->containerAction->get(ScreenShotAction::class);
        $action->setPath($path);
        $this->execute($action);
    }

    /**
     * @param int $x
     * @param int $y
     * @param bool $left
     */
    public function click(int $x, int $y, $left = true): void
    {
        $action = $this->containerAction->get(ClickAction::class);
        $action->setX($x);
        $action->setY($y);
        $action->setLeft($left);
        $this->execute($action);
    }

    /**
     * @param int $x
     * @param int $y
     */
    public function scroll(int $x, int $y): void
    {
        $action = $this->containerAction->get(ScrollAction::class);
        $action->setX($x);
        $action->setY($y);
        $this->execute($action);
    }

    /**
     * @param string $text
     */
    public function copy(string $text): void
    {
        $action = $this->containerAction->get(CopyAction::class);
        $this->execute($action);
    }

    /**
     * @param string $text
     */
    public function clipboard(string $text): void
    {
        $action = $this->containerAction->get(ClipboardAction::class);
        $action->setText($text);
        $this->execute($action);
    }

    public function paste(): void
    {
        $action = $this->containerAction->get(PasteAction::class);
        $this->execute($action);
    }

    /**
     * @param string $key
     */
    public function key(string $key): void
    {
        $action = $this->containerAction->get(KeyAction::class);
        $action->setKey($key);
        $this->execute($action);
    }

    /**
     * @param int $second
     */
    public function sleep(int $second): void
    {
        sleep($second);
    }

    /**
     * @param int $microsecond
     */
    public function usleep(int $microsecond): void
    {
        usleep($microsecond);
    }
}