<?php

namespace Modules\Core\Components\Form;

use Modules\Core\Components\Form\Traits\HandlesDefaultAndOldValue;
use Modules\Core\Components\Form\Traits\HandlesValidationErrors;

class FormInput extends BaseFormComponent
{
    use HandlesValidationErrors;
    use HandlesDefaultAndOldValue;

    public string $name;
    public string $label;
    public string $type;
    public mixed $value;
    public bool $required;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $label
     * @param string $type
     * @param bool $required
     * @param mixed|null $bind
     * @param mixed|null $default
     * @param string|null $language
     * @param bool $showErrors
     */
    public function __construct(
        string $name = '',
        string $label = '',
        string $type = 'text',
        bool $required = false,
        mixed $bind = null,
        mixed $default = null,
        ?string $language = null,
        bool $showErrors = true
    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->required = $required;
        $this->showErrors = $showErrors;

        if ($language) {
            $this->name = "{$name}[{$language}]";
        }

        $this->setValue($name, $bind, $default, $language);
    }
}
