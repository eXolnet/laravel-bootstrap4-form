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
        $this->formBuilder->considerRequest();
        $formGroup = $this->formBuilder->bsFormGroup('formgroupName', 'formgroupLabel');

        $expextedFormGroup = new FormGroupBuilder('formgroupName', 'formgroupLabel');

        $this->assertEquals($expextedFormGroup, $formGroup);
    }

    /**
     * @return void
     */
    public function testBsSelect(): void
    {
        $this->formBuilder->considerRequest();
        $element = $this->formBuilder->bsSelect(
            'elementName',
            'elementLabel',
            [1 => '1', 2 => '2'],
            2,
            ['class' => 'elementClass'],
            ['class' => 'elementOptionsClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
            <label for="elementName" class="form-label">elementLabel</label>
            <div class="form-group__input">
                <select class="form-control elementClass" id="elementName" name="elementName">
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
        $this->formBuilder->considerRequest();
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
                <input class="form-control elementClass" checked="checked" name="elementName" type="checkbox"
                    id="elementName">
                <label for="elementName" class="form-label">elementLabel</label>
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
        $this->formBuilder->considerRequest();
        $element = $this->formBuilder->bsDate(
            'elementName',
            'elementLabel',
            '2021-01-01',
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
            <label for="elementName" class="form-label">elementLabel</label>
            <div class="form-group__input">
            <input class="elementClass" name="elementName" type="text" value="2021-01-01" id="elementName">
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
        $this->formBuilder->considerRequest();
        $element = $this->formBuilder->bsTextarea(
            'elementName',
            'elementLabel',
            'textarea Value',
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
            <label for="elementName" class="form-label">elementLabel</label>
            <div class="form-group__input">
                <textarea class="elementClass" name="elementName" cols="50" rows="10" id="elementName">
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
        $this->formBuilder->considerRequest();
        $element = $this->formBuilder->bsText(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
                <label for="elementName" class="form-label">elementLabel</label>
                <div class="form-group__input">
                    <input class="form-control elementClass" name="elementName" type="text" value="textValue"
                    id="elementName">
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
        $this->formBuilder->considerRequest();
        $element = $this->formBuilder->bsText(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass', 'readonly']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
                <label for="elementName" class="form-label">elementLabel</label>
                <div class="form-group__input">
                    <input class="form-control elementClass" readonly="readonly" tabIndex="-1"
                    name="elementName" type="text" value="textValue" id="elementName">
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
        $this->formBuilder->considerRequest();
        $element = $this->formBuilder->bsText(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass', 'required']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group__required form-group">
                <label for="elementName" class="form-label">elementLabel</label>
                <div class="form-group__input">
                    <input class="form-control elementClass" required="required"
                    name="elementName" type="text" value="textValue" id="elementName">
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
        $this->formBuilder->considerRequest();
        $element = $this->formBuilder->bsEmail(
            'elementName',
            'elementLabel',
            'text Value',
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
                <label for="elementName" class="form-label">elementLabel</label>
                <div class="form-group__input">
                    <input class="form-control elementClass" name="elementName" type="email" value="textValue"
                    id="elementName">
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
        $this->formBuilder->considerRequest();
        $element = $this->formBuilder->bsPassword(
            'elementName',
            'elementLabel',
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
            <label for="elementName" class="form-label">elementLabel</label>
            <div class="form-group__input">
                <input class="form-control elementClass" name="elementName" type="password" value="" id="elementName">
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
        $this->formBuilder->considerRequest();
        $element = $this->formBuilder->bsNumber(
            'elementName',
            'elementLabel',
            110,
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
            <label for="elementName" class="form-label">elementLabel</label>
            <div class="form-group__input">
                <input class="form-control elementClass" name="elementName" type="number" value="110" id="elementName">
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
        $this->formBuilder->considerRequest();
        $element = $this->formBuilder->bsTel(
            'elementName',
            'elementLabel',
            110,
            ['class' => 'elementClass']
        );
        $html = $this->stripHtml($element->render());

        $expectedElement = '<div class="form-group--label-before form-group">
            <label for="elementName" class="form-label">elementLabel</label>
            <div class="form-group__input">
                <input class="form-control elementClass" name="elementName" type="tel" value="110" id="elementName">
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
                    <select class="form-control" name="select">
                        <option value="" selected="selected">EmptyLabel</option>
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
                    <select class="form-control" multiple="multiple" name="select">
                        <option value="">EmptyLabel</option>
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
                    <select class="form-control" multiple="multiple" name="select">
                        <option value="9999">Second element label</option>
                        <option value="8888">Third element label</option>
                    </select>
                </div>
            </div>';

        $expectedElement = $this->stripHtml($expectedElement);
        $this->assertEquals($expectedElement, $html);
    }
}
