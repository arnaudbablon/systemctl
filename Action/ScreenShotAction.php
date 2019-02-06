<?php
namespace SystemCtl\Action;

class ScreenShotAction implements ActionInterface
{
    /** @var string */
    private $path;

    public function execute(): void
    {
        exec("shutter -f -o $this->path -e -n > /dev/null 2>&1");
    }

    public function support(string $className): bool
    {
        return $className === self::class;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }
}