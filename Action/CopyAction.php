<?php
namespace SystemCtl\Action;

class CopyAction implements ActionInterface
{
    /** string */
    private $text;

    public function execute(): void
    {
        exec("echo $this->text | xclip -selection c > /dev/null 2>&1");
    }

    public function support(string $className): bool
    {
        return $className === self::class;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }
}