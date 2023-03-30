<?php namespace VseProsto\Telegram;

use Backend;
use System\Classes\PluginBase;
use System\Classes\PluginManager;
use VseProsto\Telegram\Models\TelegramUser;

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
        $obPluginManager = PluginManager::instance();
        if ($obPluginManager->exists('RainLab.User')) {
            \RainLab\User\Models\User::extend(function ($model) {
                $model->belongsTo['telegram_user'] = [TelegramUser::class,'key' => 'telegram_id'];
                $rules = $model->rules;
                $rules['email'] = 'required_without:telegram_id|between:6,255|email|unique:users';
                $model->rules = $rules;

            });
        }
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'VseProsto\Telegram\Components\TelegramAuth' => 'TelegramAuth',
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'vseprosto.telegram::lang.settings.page_name',
                'description' => 'vseprosto.telegram::lang.settings.page_desc',
                'category'    => 'vseprosto.telegram::lang.plugin.name',
                'icon'        => 'icon-paper-plane',
                'class'       => 'Vseprosto\Telegram\Models\TelegramInfoSettings',
                'order'       => 500,
                'keywords'    => 'telegram bot',
                'permissions' => ['vseprosto.telegram.settings']
            ]
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'Vseprosto\Telegram\FormWidgets\CheckWebhook' => [
                'label' => 'Telegram check webhook button',
                'code'  => 'checkwebhook',
                'alias'  => 'checkwebhook',
            ],
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
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate
    }
}
