<?php

namespace WireTable\Console;

use Illuminate\Console\GeneratorCommand;

class MakeWireTableCommand extends GeneratorCommand
{
    protected $name = 'make:wiretable';

    protected $description = 'Creates a new WireTable component';

    public function handle(): ?bool
    {
        return parent::handle();
    }

    protected function getStub(): string
    {
        return __DIR__.'/stubs/DummyWireTable.php.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Livewire';
    }
}
