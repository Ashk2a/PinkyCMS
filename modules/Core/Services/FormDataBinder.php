<?php

namespace Modules\Core\Services;

use Illuminate\Support\Arr;

class FormDataBinder
{
    /**
     * Tree of bound targets.
     */
    private array $bindings = [];

    /**
     * Wired to a Livewire component.
     */
    private string $wire = '';

    /**
     * Bind a target to the current instance
     *
     * @param mixed $target
     * @return void
     */
    public function bind(mixed $target): void
    {
        $this->bindings[] = $target;
    }

    /**
     * Get the latest bound target.
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return Arr::last($this->bindings);
    }

    /**
     * Remove the last binding.
     *
     * @return void
     */
    public function pop(): void
    {
        array_pop($this->bindings);
    }

    /**
     * Returns whether the form is bound to a Livewire model.
     *
     * @return boolean
     */
    public function isWired(): bool
    {
        return !empty($this->wire);
    }

    /**
     * Returns the modifier, if set.
     *
     * @return string|null
     */
    public function getWireModifier(): ?string
    {
        return !empty($this->wire) ? $this->wire : null;
    }

    /**
     * Enable Livewire binding with an optional modifier.
     *
     * @param string $modifier
     * @return void
     */
    public function wire(string $modifier = ''): void
    {
        $this->wire = $modifier;
    }

    /**
     * Disable Livewire binding.
     *
     * @return void
     */
    public function endWire(): void
    {
        $this->wire = '';
    }
}
