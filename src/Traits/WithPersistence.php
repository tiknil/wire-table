<?php

namespace WireTable\Traits;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

trait WithPersistence
{
    public function mountWithPersistence(): void
    {
        $sessionData = Session::get($this->persistenceKey());

        foreach (($this->persist ?? []) as $dataKey) {
            $this->$dataKey = $sessionData[$dataKey] ?? $this->$dataKey;
        }

    }

    public function dehydrateWithPersistence(): void
    {
        $data = [];

        foreach (($this->persist ?? []) as $dataKey) {
            $data[$dataKey] = $this->$dataKey;
        }

        Session::put($this->persistenceKey(), $data);
    }

    public function clearPersistence(): void
    {
        Session::remove($this->persistenceKey());
    }

    private function persistenceKey(): string
    {
        if (!empty($this->sessionKey)) {
            return 'wire:'.$this->sessionKey;
        }

        return 'wire:'.Str::slug(Str::remove('App\Http\Livewire\\', get_class($this)));
    }
}
