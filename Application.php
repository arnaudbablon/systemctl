<?php
namespace SystemCtl;

use Psr\Container\ContainerInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use SystemCtl\Action\ActionInterface;
use SystemCtl\Action\ClickAction;
use SystemCtl\Action\ClipboardAction;
use SystemCtl\Action\CopyAction;
use SystemCtl\Action\KeyAction;
use SystemCtl\Action\KillallAction;
use SystemCtl\Action\PasteAction;
use SystemCtl\Action\RunAction;
use SystemCtl\Action\ScreenShotAction;
use SystemCtl\Action\ScrollAction;
use SystemCtl\Container\ActionContainer;

class Application
{
    /** @var ActionContainer */
    protected $container;

    /**
     * Application constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param ActionInterface $action
     */
    public function execute(ActionInterface $action): void
    {
        try {
            $action->execute();
        } catch (ProcessFailedException $e) {
            trigger_error($e->getMessage());
        }
    }

    /**
     * @param string $path
     */
    public function screenShot(string $path): void
    {
        $action = $this->container->get(ScreenShotAction::class);
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
        $action = $this->container->get(ClickAction::class);
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
        $action = $this->container->get(ScrollAction::class);
        $action->setX($x);
        $action->setY($y);
        $this->execute($action);
    }

    /**
     * @param string $text
     */
    public function copy(string $text): void
    {
        $action = $this->container->get(CopyAction::class);
        $this->execute($action);
    }

    /**
     * @param string $text
     */
    public function clipboard(string $text): void
    {
        $action = $this->container->get(ClipboardAction::class);
        $action->setText($text);
        $this->execute($action);
    }

    public function paste(): void
    {
        $action = $this->container->get(PasteAction::class);
        $this->execute($action);
    }

    /**
     * @param string $key
     */
    public function key(string $key): void
    {
        $action = $this->container->get(KeyAction::class);
        $action->setKey($key);
        $this->execute($action);
    }

    /**
     * @param string $command
     */
    public function run(string $command): void
    {
        $action = $this->container->get(RunAction::class);
        $action->setCommand($command);
        $this->execute($action);
    }

    /**
     * @param string $process
     * @example $this->killall('google-chrome');
     */
    public function killall(string $process): void
    {
        $action = $this->container->get(KillallAction::class);
        $action->setProcess($process);
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