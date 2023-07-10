<?php

namespace Exolnet\LaravelBootstrap4Form\Tests\Integration;

use Exolnet\HtmlList\HtmlList;
use Exolnet\LaravelBootstrap4Form\Support\FormGroupBuilder;
use Exolnet\LaravelBootstrap4Form\Tests\Mocks\HtmlItemMock;
use Illuminate\Support\Collection;

class Bootstrap4FormServiceProviderTest extends TestCase
{
    /**
     * @return void
     */
    public function testBsFormGroup(): void
    {
        $formGroup = $this->formBuilder->bsFormGroup('formgroupName', 'formgroupLabel');

        $expextedFormGroup = new FormGroupBuilder('formgroupName', 'formgroupLabel');

        $this->assertEquals($expextedFormGroup, $formGroup);
    }

    /**
     * @return void
     */
    public function testBsSelect(): void
    {
        $element = $this->formBuilder->bsSelect(
            'elementName',
            'elementLabel',
            [1 => '1', 2 => '2'],
            2,
            ['class' => 'elementClass'],
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
            <label for="elementName">elementLabel</label>
            <div class="form-group__input">
                <select class="form-control elementClass" name="elementName" id="elementName">
                    <option value="1">1</option>
                    <option value="2" selected="selected">2</option>
                </select>
            </div>
        </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testBsCheckbox(): void
    {
        $element = $this->formBuilder->bsCheckbox(
            'elementName',
            'elementLabel',
            null,
            true,
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-beside form-group">
            <div class="form-group__input">
                <input class="form-control elementClass" type="checkbox" name="elementName"
                    id="elementName" checked>
                <label for="elementName">elementLabel</label>
            </div>
        </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testBsDate(): void
    {
        $element = $this->formBuilder->bsDate(
            'elementName',
            'elementLabel',
            '2021-01-01',
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
            <label for="elementName">elementLabel</label>
            <div class="form-group__input">
            <input class="elementClass" type="text" name="elementName" id="elementName" value="2021-01-01">
            </div>
        </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testBsTextarea(): void
    {
        $element = $this->formBuilder->bsTextarea(
            'elementName',
            'elementLabel',
            'textarea Value',
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
            <label for="elementName">elementLabel</label>
            <div class="form-group__input">
                <textarea class="elementClass" name="elementName" id="elementName">
                    textareaValue
                </textarea>
            </div>
        </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testBsText(): void
    {
        $element = $this->formBuilder->bsText(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

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

    /**
     * @return void
     */
    public function testBsTextWithReadonly(): void
    {
        $element = $this->formBuilder->bsText(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass', 'readonly']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
                <label for="elementName">elementLabel</label>
                <div class="form-group__input">
                    <input class="form-control elementClass" type="text" name="elementName" id="elementName"
                    value="textValue" readonly="readonly" tabIndex="-1">
                </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testBsTextWithRequired(): void
    {
        $element = $this->formBuilder->bsText(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass', 'required']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group__required form-group">
                <label for="elementName">elementLabel</label>
                <div class="form-group__input">
                    <input class="form-control elementClass" type="text" name="elementName" id="elementName"
                    value="textValue" required="required">
                </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testBsEmail(): void
    {
        $element = $this->formBuilder->bsEmail(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
                <label for="elementName">elementLabel</label>
                <div class="form-group__input">
                    <input class="form-control elementClass" type="email" name="elementName" id="elementName"
                    value="textValue">
                </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testBsPassword(): void
    {
        $element = $this->formBuilder->bsPassword(
            'elementName',
            'elementLabel',
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
            <label for="elementName">elementLabel</label>
            <div class="form-group__input">
                <input class="form-control elementClass" type="password" name="elementName" id="elementName">
            </div>
        </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testBsNumber(): void
    {
        $element = $this->formBuilder->bsNumber(
            'elementName',
            'elementLabel',
            110,
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
            <label for="elementName">elementLabel</label>
            <div class="form-group__input">
                <input class="form-control elementClass" type="number" name="elementName" id="elementName" value="110">
            </div>
        </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testBsTel(): void
    {
        $element = $this->formBuilder->bsTel(
            'elementName',
            'elementLabel',
            110,
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
            <label for="elementName">elementLabel</label>
            <div class="form-group__input">
                <input class="form-control elementClass" type="tel" name="elementName" id="elementName" value="110">
            </div>
        </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testHtmlListBsSelect(): void
    {
        $item = new HtmlItemMock();
        $item->label = 'Second element label';
        $item->id = 9999;

        $collection = new Collection([
            $item,
        ]);

        /** @var HtmlList $actual */
        $htmlList = $collection->toHtmlList();
        $htmlList->allowEmpty('Empty Label');

        $html = $this->stripHtml($htmlList->bsSelect('select')->render());

        $expectedElement = '<div class="form-group--label-before form-group">
                <div class="form-group__input">
                    <select class="form-control" name="select" id="select">
                        <option value>EmptyLabel</option>
                        <option value="9999">Secondel ement label</option>
                    </select>
                </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testHtmlListBsSelectMultiple(): void
    {
        $item = new HtmlItemMock();
        $item->label = 'Second element label';
        $item->id = 9999;

        $item2 = new HtmlItemMock();
        $item2->label = 'Third element label';
        $item2->id = 8888;

        $collection = new Collection([
            $item,
            $item2
        ]);

        /** @var HtmlList $actual */
        $htmlList = $collection->toHtmlList();
        $htmlList->allowEmpty('Empty Label');

        $html = $this->stripHtml($htmlList->bsSelect('select', null, [9999, 8888], ['multiple'])->render());

        $expectedElement = '<div class="form-group--label-before form-group">
                <div class="form-group__input">
                    <select class="form-control" name="select[]" id="select" multiple>
                        <option value>EmptyLabel</option>
                        <option value="9999" selected="selected">Second element label</option>
                        <option value="8888" selected="selected">Third element label</option>
                    </select>
                </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }

    /**
     * @return void
     */
    public function testHtmlListBsSelectMultipleEmptySelected(): void
    {
        $item = new HtmlItemMock();
        $item->label = 'Second element label';
        $item->id = 9999;

        $item2 = new HtmlItemMock();
        $item2->label = 'Third element label';
        $item2->id = 8888;

        $collection = new Collection([
            $item,
            $item2
        ]);

        /** @var HtmlList $actual */
        $htmlList = $collection->toHtmlList();

        $html = $this->stripHtml($htmlList->bsSelect('select', null, null, ['multiple'])->render());

        $expectedElement = '<div class="form-group--label-before form-group">
                <div class="form-group__input">
                    <select class="form-control" name="select[]" id="select" multiple>
                        <option value="9999">Second element label</option>
                        <option value="8888">Third element label</option>
                    </select>
                </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }
}
