<?php
/**
 * This file is part of the Telegram plugin for OctoberCMS.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) Anton Romanov <iam+octobercms@theone74.ru>
 */

use VseProsto\Telegram\Classes\TelegramApi;
use \Longman\TelegramBot\Exception\TelegramException;
use \VseProsto\Telegram\Models\TelegramInfoSettings;


Route::any('/telehook/{token}', array(function($token){

    if (TelegramInfoSettings::instance()->get('token') != $token) {
        \Log::error('Undefined token '.$token);
        App::abort(403, 'Unauthorized action.');
    }

    try {
        Event::fire('telegram.init', []);

        // Create Telegram API object
        $telegram = TelegramApi::instance();

        Event::fire('telegram.beforeReceive', []);

        // Handle telegram webhook request
        $telegram->handle();

        Event::fire('telegram.afterReceive', []);

    } catch (TelegramException $e) {
        \Log::error($e);
    }
}));