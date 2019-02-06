<?php
namespace SystemCtl\Action;

class KeyAction implements ActionInterface
{
    /** string */
    private $key;

    public function execute(): void
    {
        exec("xdotool key $this->key");
    }

    public function support(string $className): bool
    {
        return $className === self::class;
    }

    /**
     * @param mixed $text
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }
}