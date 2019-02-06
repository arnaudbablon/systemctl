<?php
namespace SystemCtl\Container;

use SystemCtl\Action\ActionInterface;
use Psr\Container\ContainerInterface;

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
     * @return ActionInterface|mixed
     * @throws ContainerException
     * @throws ContainerNotFoundException
     */
    public function get($id)
    {
        foreach ($this->actions as $action) {
            if ($this->has($id)) {
                try {
                    if ($action->support($id)) {
                        return $action;
                    }
                } catch (\Exception $e) {
                    throw new ContainerException(sprintf('Error while retrieving the entry %s', $id));
                }
            }
        }

        throw new ContainerNotFoundException(sprintf('No entry was found for %d identifier', $id));
    }
}