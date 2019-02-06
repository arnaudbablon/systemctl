<?php
namespace SystemCtl\Container;

use SystemCtl\Action\ActionInterface;

class ActionContainer implements ContainerInterface
{
    /** @var ActionInterface[] */
    private $actions;

    public function __construct(iterable $actions)
    {
        $this->actions = $actions;
    }

    public function has($id)
    {
        foreach ($this->actions as $action) {
            if ($action->support($id)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $id
     * @return ActionInterface
     * @throws ContainerNotFoundException
     */
    public function get($id)
    {
        foreach ($this->actions as $action) {
            if ($this->has($id)) {
                if ($action->support($id)) {
                    return $action;
                }
            }
        }

        throw new ContainerNotFoundException(sprintf('No entry was found for %d identifier', $id));
    }
}