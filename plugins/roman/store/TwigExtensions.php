<?php

namespace Vendor\MyPlugin;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TwigExtensions extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('json_decode', [$this, 'jsonDecode']),
        ];
    }

    public function jsonDecode($string, $assoc = true)
    {
        return json_decode($string, $assoc);
    }
}