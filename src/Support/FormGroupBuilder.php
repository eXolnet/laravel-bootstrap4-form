<?php

namespace Exolnet\LaravelBootstrap4Form\Support;

use Collective\Html\FormFacade;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class FormGroupBuilder implements Htmlable
{
    /**
     * @var array
     */
    protected const DEFAULT_GROUP_OPTIONS = ['class' => 'form-group'];

    /**
     * @var array
     */
    protected const DEFAULT_INPUT_OPTIONS = ['class' => 'form-control'];

    /**
     * @var string
     */
    public const LABEL_LOCATION_BEFORE = 'before';

    /**
     * @var string
     */
    public const LABEL_LOCATION_BESIDE = 'beside';

    /**
     * @var string
     */
    public const LABEL_LOCATION_BESIDE_ONLY = 'beside-only';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Exolnet\LaravelBootstrap4Form\Support\AttributeBag
     */
    protected $attributes;

    /**
     * @var \Illuminate\Support\HtmlString
     */
    protected $label;

    /**
     * @var string
     */
    protected $labelLocation = self::LABEL_LOCATION_BEFORE;

    /**
     * @var string
     */
    protected $tooltip;

    /**
     * @var \Illuminate\Support\HtmlString|null
     */
    protected $input;

    /**
     * @param string $name
     * @param \Illuminate\Contracts\Support\Htmlable|string|null $label
     * @param array $labelOptions
     * @param bool $labelEscapeHtml
     */
    public function __construct(string $name, $label = null, $labelOptions = [], $labelEscapeHtml = true)
    {
        $this->name = $name;
        $this->attributes = new AttributeBag(static::DEFAULT_GROUP_OPTIONS);

        if ($label instanceof Htmlable) {
            $labelEscapeHtml = false;
        }

        if ($label) {
            $this->label = FormFacade::label($name, $label, $labelOptions, $labelEscapeHtml);
        }
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        /** \Illuminate\Support\ViewErrorBag $errorBag */
        if (! $errorBag = Session::get('errors')) {
            return false;
        }

        if ($errorBag->has(Helper::stringArrayToDotNotation($this->name))) {
            return true;
        }

        return $errorBag->has($this->name);
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = new AttributeBag($attributes);

        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function mergeAttributes(array $attributes): self
    {
        $this->attributes = $this->attributes->merge($attributes);

        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function tooltip(string $text): self
    {
        $this->tooltip = $text;

        return $this;
    }

    /**
     * @param mixed $label
     * @return $this
     */
    public function besideOnlyLabel(): self
    {
        $this->labelLocation = self::LABEL_LOCATION_BESIDE_ONLY;

        return $this;
    }

    /**
     * @param mixed $label
     * @return $this
     */
    public function rawLabel($label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @param mixed $input
     * @return $this
     */
    public function rawInput($input): self
    {
        $this->input = $input;

        return $this;
    }

    /**
     * @param string|null $value
     * @param array $options
     * @return $this
     */
    public function text(string $value = null, array $options = []): self
    {
        $this->input = FormFacade::text($this->name, $value, $this->parseInputOptions($options)->all());

        return $this;
    }

    /**
     * @param string|null $value
     * @param array $options
     * @return $this
     */
    public function textRaw(string $value = null, array $options = []): self
    {
        $this->input = FormFacade::text($this->name, $value, $this->parseInputOptions($options, [])->all());

        return $this;
    }

    /**
     * @param string|null $value
     * @param bool|null $checked
     * @param array $options
     * @return $this
     */
    public function checkbox(?string $value = '1', ?bool $checked = null, array $options = []): self
    {
        $this->labelLocation = self::LABEL_LOCATION_BESIDE;
        $this->input = FormFacade::checkbox($this->name, $value, $checked, $this->parseInputOptions($options)->all());

        return $this;
    }

    /**
     * @param string|null $value
     * @param array $options
     * @return $this
     */
    public function date(?string $value = null, array $options = []): self
    {
        $this->input = FormFacade::text(
            $this->name,
            $value,
            $this->parseInputOptions($options, [])->all()
        );

        return $this;
    }

    /**
     * @param string|null $value
     * @param array $options
     * @return $this
     */
    public function textarea(?string $value = null, array $options = []): self
    {
        $this->input = FormFacade::textarea(
            $this->name,
            $value,
            $this->parseInputOptions($options, [])->all()
        );

        return $this;
    }

    /**
     * @param string|null $value
     * @param array $options
     * @return $this
     */
    public function email(?string $value = null, array $options = []): self
    {
        $this->input = FormFacade::email($this->name, $value, $this->parseInputOptions($options)->all());

        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function password(array $options = []): self
    {
        $this->input = FormFacade::password($this->name, $this->parseInputOptions($options)->all());

        return $this;
    }

    /**
     * @param string|null $value
     * @param array $options
     * @return $this
     */
    public function number(?string $value = null, array $options = []): self
    {
        $this->input = FormFacade::number($this->name, $value, $this->parseInputOptions($options)->all());

        return $this;
    }

    /**
     * @param array $list
     * @param string|array|null $selected
     * @param array $selectAttributes
     * @param array $optionsAttributes
     * @param array $optgroupsAttributes
     * @return $this
     */
    public function select(
        array $list = [],
        $selected = null,
        array $selectAttributes = [],
        array $optionsAttributes = [],
        array $optgroupsAttributes = []
    ) {
        $this->input = FormFacade::select(
            $this->name,
            $list,
            $selected,
            $this->parseInputOptions($selectAttributes)->all(),
            $optionsAttributes,
            $optgroupsAttributes
        );

        return $this;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        return view('laravelbootstrap4form::form-group', [
            'name' => $this->name,
            'attributes' => $this->attributes->all(),
            'label' => $this->label,
            'labelLocation' => $this->labelLocation,
            'input' => $this->input,
            'tooltip' => $this->tooltip,
        ]);
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return $this->view()->render();
    }

    /**
     * @inheritDoc
     */
    public function toHtml()
    {
        return $this->render();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }

    /**
     * @param array $options
     * @param array $defaultOptions
     * @return Exolnet\LaravelBootstrap4Form\Support\AttributeBag
     */
    protected function parseInputOptions(
        array $options,
        array $defaultOptions = self::DEFAULT_INPUT_OPTIONS
    ): AttributeBag {
        $options = (new AttributeBag($options))->merge($defaultOptions);

        if ($this->hasError()) {
            $options = $options->merge(['class' => 'is-invalid']);
            $this->mergeAttributes(['class' => 'form-group__has-error']);
        }

        if ($options->get('required')) {
            $this->mergeAttributes(['class' => 'form-group__required']);
        }

        return $options;
    }
}
