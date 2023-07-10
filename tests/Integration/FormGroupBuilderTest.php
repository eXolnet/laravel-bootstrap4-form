<?php

namespace Exolnet\LaravelBootstrap4Form\Tests\Integration;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class FormGroupBuilderTest extends TestCase
{
    /**
     * @return void
     */
    public function testHasError(): void
    {
        $errorBag = new ViewErrorBag();
        $messageBag = new MessageBag([
            'elementName' => 'Problem with element Name'
        ]);
        $errorBag->put('default', $messageBag);

        $this->withSession(['errors' => $errorBag]);

        /** @var \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder $element */
        $element = $this->formBuilder->bsText(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass']
        );

        $html = $this->stripHtml($element->toHtml());

        $expectedElement = '<div class="form-group--label-before form-group__has-error form-group">
            <label for="elementName">elementLabel</label>
            <div class="form-group__input">
                <input class="is-invalid form-control elementClass" type="text" name="elementName" id="elementName"
                value="textValue">
                <span class="invalid-feedback">
                    <strong>Problem with element Name</strong>
                </span>
            </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testTooltip(): void
    {
        /** @var \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder $element */
        $element = $this->formBuilder->bsText(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass']
        )->tooltip('This is a tooltip for this input text');

        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
                <label for="elementName">elementLabel</label>
                <span class="d-inline-block d-print-none" tabindex="-1" data-toggle="tooltip"
                title="This is a tooltip for this input text">
                    @svg(\'info-circle\')
                </span>
                <div class="form-group__input">
                    <input class="form-control elementClass" type="text" name="elementName" id="elementName"
                    value="textValue">
                </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testLabelBeside(): void
    {
        /** @var \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder $element */
        $element = $this->formBuilder->bsText(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass']
        )->besideOnlyLabel();

        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-beside-only form-group">
                <div class="form-group__input">
                    <input class="form-control elementClass" type="text" name="elementName" id="elementName"
                    value="textValue"><label for="elementName">elementLabel</label>
                </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testRawLabel(): void
    {
        /** @var \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder $element */
        $element = $this->formBuilder->bsText(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass']
        )->rawLabel('raw label');

        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
                raw label
                <div class="form-group__input">
                    <input class="form-control elementClass" type="text" name="elementName" id="elementName"
                    value="textValue">
                </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testRawInput(): void
    {
        /** @var \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder $element */
        $element = $this->formBuilder->bsText(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass']
        )->rawInput('Raw input');

        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
                <label for="elementName">elementLabel</label>
                <div class="form-group__input">
                    Raw input
                </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testTextWithSetAttributes(): void
    {
        /** @var \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder $element */
        $element = $this->formBuilder->bsText(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass']
        )->setAttributes([
            'v-model' => 'bbb'
        ]);

        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before" v-model="bbb">
                <label for="elementName">elementLabel</label>
                <div class="form-group__input">
                    <input class="form-control elementClass" type="text" name="elementName" id="elementName"
                    value="textValue">
                </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }


    /**
     * @return void
     */
    public function testToString(): void
    {
        /** @var \Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder $element */
        $element = $this->formBuilder->bsText(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass']
        );

        $html = $this->stripHtml($element);

        $expectedElement = '<div class="form-group--label-before form-group">
                <label for="elementName">elementLabel</label>
                <div class="form-group__input">
                    <input class="form-control elementClass" type="text" name="elementName" id="elementName"
                    value="textValue">
                </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }
}
