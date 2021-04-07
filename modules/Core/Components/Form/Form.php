<?php

namespace Modules\Core\Components\Form;

use Illuminate\Support\ViewErrorBag;
use JetBrains\PhpStorm\Pure;

class Form extends BaseFormComponent
{
    /**
     * Request method.
     */
    public string $method;

    /**
     * Form method spoofing to support PUT, PATCH and DELETE actions.
     * https://laravel.com/docs/master/routing#form-method-spoofing
     */
    public bool $spoofMethod = false;

    /**
     * Create a new component instance.
     *
     * @param string $method
     */
    #[Pure] public function __construct(string $method = 'POST')
    {
        $this->method = strtoupper($method);

        $this->spoofMethod = in_array($this->method, ['PUT', 'PATCH', 'DELETE']);
    }

    /**
     * Returns a boolean whether the error bag is not empty.
     *
     * @param string $bag
     * @return boolean
     */
    public function hasError(string $bag = 'default'): bool
    {
        $errors = view()->shared('errors', fn() => request()->session()->get('errors', new ViewErrorBag));

        return $errors->getBag($bag)->isNotEmpty();
    }
}
