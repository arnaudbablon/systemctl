<?php
namespace SystemCtl\Action;

class PasteAction implements ActionInterface
{
    public function execute(): void
    {
        exec("xdotool key ctrl+v");
    }

    public function support(string $className): bool
    {
        return $className === self::class;
    }
}