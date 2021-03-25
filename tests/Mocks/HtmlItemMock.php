<?php

namespace Exolnet\LaravelBootstrap4Form\Tests\Mocks;

use Exolnet\HtmlList\Items\HtmlItem;
use Exolnet\HtmlList\Items\HtmlItemDefaults;
use Illuminate\Database\Eloquent\Model;

class HtmlItemMock extends Model implements HtmlItem
{
    use HtmlItemDefaults;
}
