<?php namespace VseProsto\Telegram;

use Backend;
use System\Classes\PluginBase;

/**
 * Telegram Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Telegram',
            'description' => 'Для работы с вашим ботом',
            'author'      => 'VseProsto',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'VseProsto\Telegram\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'vseprosto.telegram.some_permission' => [
                'tab' => 'Telegram',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'telegram' => [
                'label'       => 'Telegram',
                'url'         => Backend::url('vseprosto/telegram/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['vseprosto.telegram.*'],
                'order'       => 500,
            ],
        ];
    }
}
