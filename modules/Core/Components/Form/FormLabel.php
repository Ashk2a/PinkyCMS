<?php

namespace Modules\Core\Components\Form;

class FormLabel extends BaseFormComponent
{
    public string $label;
    public bool $required;

    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param bool $required
     */
    public function __construct(string $label = '', bool $required = false)
    {
        $this->label = $label;
        $this->required = $required;
    }
}
