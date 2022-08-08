<?php

namespace Masoudi\Nova;

use Laravel\Nova\Fields\Text;

class TextList extends Text
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'masoudi-tags-field';
}
