<?php

namespace Modules\Core\Components\Form;

use Modules\Core\Components\Form\Traits\HandlesBoundValues;
use Modules\Core\Components\Form\Traits\HandlesValidationErrors;

class FormRadio extends BaseFormComponent
{
    use HandlesValidationErrors;
    use HandlesBoundValues;

    public string $label;
    public int $value;
    public bool $checked = false;

    public function __construct(
        string $name,
        string $label = '',
        int $value = 1,
        mixed $bind = null,
        bool $default = false,
        bool $showErrors = false
    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->showErrors = $showErrors;

        $inputName = static::convertBracketsToDots($name);

        if (old($inputName)) {
            $this->checked = old($inputName) == $value;
        }

        if (!session()->hasOldInput() && $this->isNotWired()) {
            $boundValue = $this->getBoundValue($bind, $name);

            if (!is_null($boundValue)) {
                $this->checked = $boundValue == $this->value;
            } else {
                $this->checked = $default;
            }
        }
    }

    /**
     * Generates an ID by the name and value attributes.
     *
     * @return string
     */
    protected function generateIdByName(): string
    {
        return "auto_id_" . $this->name . "_" . $this->value;
    }
}
