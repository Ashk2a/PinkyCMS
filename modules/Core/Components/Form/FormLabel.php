<?php

namespace Modules\Core\Components\Form;

class FormLabel extends BaseFormComponent
{
    public string $label;

    /**
     * Create a new component instance.
     *
     * @param string $label
     */
    public function __construct(string $label = '')
    {
        $this->label = $label;
    }
}
