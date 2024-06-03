<?php

namespace Roman\Store;

use Twig\TwigFilter;
use System\Classes\PluginBase;

/**
 * Plugin class
 */
class Plugin extends PluginBase
{
    
    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //$this->app['view']->getEngineResolver()->resolve('twig')->getCompiler()->addExtension(new \Roman\Store\TwigExtensions());
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        // Add a custom filter to Twig
        \App::make('twig.environment')->addFilter(new TwigFilter('json_decode', function ($json) {
            return json_decode($json, true);
        }));
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return [
            'Roman\Store\Components\ShoppingCart' => 'shoppingCart'
        ];
    }

    /**
     * registerSettings used by the backend.
     */
    public function registerSettings()
    {
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'json_decode' => [$this, 'jsonDecodeFilter'],
            ],
        ];
    }

    public function jsonDecodeFilter($string, $assoc = true)
    {
        return json_decode($string, $assoc);
    }
}
