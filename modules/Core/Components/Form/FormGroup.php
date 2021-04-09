<?php

namespace Modules\Core\Components\Form;

use Modules\Core\Components\Form\Traits\HandlesValidationErrors;

class FormGroup extends BaseFormComponent
{
    use HandlesValidationErrors;

    public string $label;
    public bool $inline = false;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $label
     * @param bool $inline
     * @param bool $showErrors
     */
    public function __construct(string $name = '', string $label = '', bool $inline = false, bool $showErrors = true)
    {
        $this->name = $name;
        $this->label = $label;
        $this->inline = $inline;
        $this->showErrors = $name && $showErrors;
    }
}
