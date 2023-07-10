<?php

namespace Exolnet\LaravelBootstrap4Form;

use Exolnet\HtmlList\HtmlList;
use Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder;
use Illuminate\Support\ServiceProvider;
use Spatie\Html\Facades\Html;

class Bootstrap4FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravelbootstrap4form');

        $this->addFormGroup();

        $this->addFormComponents();

        $this->addHtmlListMacro();
    }

    protected function addFormGroup(): void
    {
        Html::macro(
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
             * @return \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder
             */
            function (
                string $name,
                $label = null,
                $selected = null,
                array $selectAttributes = [],
            ): FormGroupBuilder {
                if (is_null($selected) && in_array('multiple', $selectAttributes)) {
                    $selected = Html::value($name) ?? [];
                }

                $selectAttributes = Bootstrap4FormServiceProvider::addTabIndexIfReadonly($selectAttributes);

                return Html::bsSelect(
                    $name,
                    $label,
                    $this->buildArray(),
                    $selected,
                    $selectAttributes
                );
            }
        );
    }

    private function addSelectComponent(): void
    {
        Html::macro(
            'bsSelect',
            /**
             * @param string $name
             * @param \Illuminate\Contracts\Support\Htmlable|string|null $label
             * @param array $list
             * @param string|array|null $selected
             * @return \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder
             */
            function (
                string $name,
                $label = null,
                array $list = [],
                $selected = null,
                array $selectAttributes = [],
            ): FormGroupBuilder {
                $selectAttributes = Bootstrap4FormServiceProvider::addTabIndexIfReadonly($selectAttributes);

                return Html::bsFormGroup($name, $label)->select($list, $selected, $selectAttributes);
            }
        );
    }

    private function addCheckboxComponent(): void
    {
        Html::macro(
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

                return Html::bsFormGroup($name, $label)->checkbox($value, $checked, $options);
            }
        );
    }

    private function addDateComponent(): void
    {
        Html::macro(
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

                return Html::bsFormGroup($name, $label)->date($value, $options);
            }
        );
    }

    private function addTextareaComponent(): void
    {
        Html::macro(
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

                return Html::bsFormGroup($name, $label)->textarea($value, $options);
            }
        );
    }

    private function addTextComponent(): void
    {
        Html::macro(
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

                return Html::bsFormGroup($name, $label)->text($value, $options);
            }
        );
    }

    private function addEmailComponent(): void
    {
        Html::macro(
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

                return Html::bsFormGroup($name, $label)->email($value, $options);
            }
        );
    }

    private function addPasswordComponent(): void
    {
        Html::macro(
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

                return Html::bsFormGroup($name, $label)->password($options);
            }
        );
    }

    private function addNumberComponent(): void
    {
        Html::macro(
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

                return Html::bsFormGroup($name, $label)->number($value, $options);
            }
        );
    }

    private function addTelComponent(): void
    {
        Html::macro(
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

                return Html::bsFormGroup($name, $label)->tel($value, $options);
            }
        );
    }

    /**
     * @param array $attributes
     * @return array
     */
    public static function addTabIndexIfReadonly(array $attributes): array
    {
        if (
            (in_array('readonly', $attributes) || array_key_exists('readonly', $attributes)) &&
            !array_key_exists('tabIndex', $attributes)
        ) {
            $attributes['tabIndex'] = -1;
        }

        return $attributes;
    }
}
