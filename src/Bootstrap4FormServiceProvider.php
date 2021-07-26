<?php

namespace Exolnet\LaravelBootstrap4Form;

use Collective\Html\FormFacade;
use Exolnet\HtmlList\HtmlList;
use Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder;
use Collective\Html\FormBuilder;
use Illuminate\Support\ServiceProvider;

class Bootstrap4FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravelbootstrap4form');

        $this->addFormMacro();

        $this->addFormGroup();

        $this->addFormComponents();

        $this->addHtmlListMacro();
    }

    protected function addFormMacro(): void
    {
        FormBuilder::macro('value', function ($name, $value = null) {
            return $this->getValueAttribute($name, $value);
        });
    }

    protected function addFormGroup(): void
    {
        FormBuilder::macro(
            'bsFormGroup',
            /**
             * @param string $name
             * @param \Illuminate\Contracts\Support\Htmlable|string|null $label
             * @param array $labelOptions
             * @param bool $labelEscapeHtml
             * @return \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder
             */
            function (
                string $name,
                $label = null,
                $labelOptions = [],
                $labelEscapeHtml = true
            ): FormGroupBuilder {
                return new FormGroupBuilder($name, $label, $labelOptions, $labelEscapeHtml);
            }
        );
    }

    private function addFormComponents(): void
    {
        $this->addSelectComponent();

        $this->addCheckboxComponent();

        $this->addDateComponent();

        $this->addTextareaComponent();

        $this->addTextComponent();

        $this->addEmailComponent();

        $this->addPasswordComponent();

        $this->addNumberComponent();

        $this->addTelComponent();
    }

    private function addHtmlListMacro(): void
    {
        HtmlList::macro(
            'bsSelect',
            /**
             * @param string $name
             * @param \Illuminate\Contracts\Support\Htmlable|string|null $label
             * @param string|array|null $selected
             * @param array $selectAttributes
             * @param array $optionsAttributes
             * @param array $optgroupsAttributes
             * @return \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder
             */
            function (
                string $name,
                $label = null,
                $selected = null,
                array $selectAttributes = [],
                array $optionsAttributes = [],
                array $optgroupsAttributes = []
            ): FormGroupBuilder {
                if (is_null($selected) && in_array('multiple', $selectAttributes)) {
                    $selected = FormFacade::value($name) ?? [];
                }

                $selectAttributes = Bootstrap4FormServiceProvider::addTabIndexIfReadonly($selectAttributes);

                return FormBuilder::bsSelect(
                    $name,
                    $label,
                    $this->buildArray(),
                    $selected,
                    $selectAttributes,
                    $optionsAttributes,
                    $optgroupsAttributes
                );
            }
        );
    }

    private function addSelectComponent(): void
    {
        FormBuilder::macro(
            'bsSelect',
            /**
             * @param string $name
             * @param \Illuminate\Contracts\Support\Htmlable|string|null $label
             * @param array $list
             * @param string|array|null $selected
             * @param array $selectAttributes
             * @param array $optionsAttributes
             * @param array $optgroupsAttributes
             * @return \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder
             */
            function (
                string $name,
                $label = null,
                array $list = [],
                $selected = null,
                array $selectAttributes = [],
                array $optionsAttributes = [],
                array $optgroupsAttributes = []
            ): FormGroupBuilder {
                $selectAttributes = Bootstrap4FormServiceProvider::addTabIndexIfReadonly($selectAttributes);

                return FormBuilder::bsFormGroup($name, $label)
                    ->select($list, $selected, $selectAttributes, $optionsAttributes, $optgroupsAttributes);
            }
        );
    }

    private function addCheckboxComponent(): void
    {
        FormBuilder::macro(
            'bsCheckbox',
            /**
             * @param string $name
             * @param \Illuminate\Contracts\Support\Htmlable|string|null $label
             * @param string|null $value
             * @param bool|null $checked
             * @param array $options
             * @return \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder
             */
            function (
                string $name,
                $label = null,
                ?string $value = '1',
                ?bool $checked = null,
                array $options = []
            ): FormGroupBuilder {
                $options = Bootstrap4FormServiceProvider::addTabIndexIfReadonly($options);

                return FormBuilder::bsFormGroup($name, $label)->checkbox($value, $checked, $options);
            }
        );
    }

    private function addDateComponent(): void
    {
        FormBuilder::macro(
            'bsDate',
            /**
             * @param string $name
             * @param \Illuminate\Contracts\Support\Htmlable|string|null $label
             * @param string|null $value
             * @param array $options
             * @return \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder
             */
            function (
                string $name,
                $label = null,
                ?string $value = null,
                array $options = []
            ): FormGroupBuilder {
                $options = Bootstrap4FormServiceProvider::addTabIndexIfReadonly($options);

                return FormBuilder::bsFormGroup($name, $label)->date($value, $options);
            }
        );
    }

    private function addTextareaComponent(): void
    {
        FormBuilder::macro(
            'bsTextarea',
            /**
             * @param string $name
             * @param \Illuminate\Contracts\Support\Htmlable|string|null $label
             * @param string|null $value
             * @param array $options
             * @return \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder
             */
            function (
                string $name,
                $label = null,
                ?string $value = null,
                array $options = []
            ): FormGroupBuilder {
                $options = Bootstrap4FormServiceProvider::addTabIndexIfReadonly($options);

                return FormBuilder::bsFormGroup($name, $label)->textarea($value, $options);
            }
        );
    }

    private function addTextComponent(): void
    {
        FormBuilder::macro(
            'bsText',
            /**
             * @param string $name
             * @param \Illuminate\Contracts\Support\Htmlable|string|null $label
             * @param string|null $value
             * @param array $options
             * @return \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder
             */
            function (
                string $name,
                $label = null,
                ?string $value = null,
                array $options = []
            ): FormGroupBuilder {
                $options = Bootstrap4FormServiceProvider::addTabIndexIfReadonly($options);

                return FormBuilder::bsFormGroup($name, $label)->text($value, $options);
            }
        );
    }

    private function addEmailComponent(): void
    {
        FormBuilder::macro(
            'bsEmail',
            /**
             * @param string $name
             * @param \Illuminate\Contracts\Support\Htmlable|string|null $label
             * @param string|null $value
             * @param array $options
             * @return \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder
             */
            function (
                string $name,
                $label = null,
                ?string $value = null,
                array $options = []
            ): FormGroupBuilder {
                $options = Bootstrap4FormServiceProvider::addTabIndexIfReadonly($options);

                return FormBuilder::bsFormGroup($name, $label)->email($value, $options);
            }
        );
    }

    private function addPasswordComponent(): void
    {
        FormBuilder::macro(
            'bsPassword',
            /**
             * @param string $name
             * @param \Illuminate\Contracts\Support\Htmlable|string|null $label
             * @param array $options
             * @return \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder
             */
            function (
                string $name,
                $label = null,
                array $options = []
            ): FormGroupBuilder {
                $options = Bootstrap4FormServiceProvider::addTabIndexIfReadonly($options);

                return FormBuilder::bsFormGroup($name, $label)->password($options);
            }
        );
    }

    private function addNumberComponent(): void
    {
        FormBuilder::macro(
            'bsNumber',
            /**
             * @param string $name
             * @param \Illuminate\Contracts\Support\Htmlable|string|null $label
             * @param string|null $value
             * @param array $options
             * @return \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder
             */
            function (
                string $name,
                $label = null,
                ?string $value = null,
                array $options = []
            ): FormGroupBuilder {
                $options = Bootstrap4FormServiceProvider::addTabIndexIfReadonly($options);

                return FormBuilder::bsFormGroup($name, $label)->number($value, $options);
            }
        );
    }

    private function addTelComponent(): void
    {
        FormBuilder::macro(
            'bsTel',
            /**
             * @param string $name
             * @param \Illuminate\Contracts\Support\Htmlable|string|null $label
             * @param string|null $value
             * @param array $options
             * @return \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder
             */
            function (
                string $name,
                $label = null,
                ?string $value = null,
                array $options = []
            ): FormGroupBuilder {
                $options = Bootstrap4FormServiceProvider::addTabIndexIfReadonly($options);

                return FormBuilder::bsFormGroup($name, $label)->tel($value, $options);
            }
        );
    }

    /**
     * @param array $attributes
     * @return array
     */
    public static function addTabIndexIfReadonly(array $attributes): array
    {
        if ((in_array('readonly', $attributes) || array_key_exists('readonly', $attributes)) &&
            !array_key_exists('tabIndex', $attributes)
        ) {
            $attributes['tabIndex'] = -1;
        }

        return $attributes;
    }
}
