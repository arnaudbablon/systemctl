<?php
namespace SystemCtl\Action;

interface ActionInterface {
    public function execute();
    public function support(string $className): bool;
}