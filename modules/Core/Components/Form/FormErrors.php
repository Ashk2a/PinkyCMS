<?php

namespace Modules\Core\Components\Form;

use Illuminate\Support\Str;

class FormErrors extends BaseFormComponent
{
    public string $bag;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $bag
     */
    public function __construct(string $name, string $bag = 'default')
    {
        $this->name = static::convertBracketsToDots(Str::before($name, '[]'));

        $this->bag = $bag;
    }
}
