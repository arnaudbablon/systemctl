<?php
namespace SystemCtl\Action;

interface ActionInterface {
    public function execute(): void;
    public function support(string $className): bool;
}