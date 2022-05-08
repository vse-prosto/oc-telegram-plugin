<?php namespace Vseprosto\Telegram\Classes;

/**
 * This file is part of the Telegram plugin for OctoberCMS.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) Anton Romanov <iam+octobercms@theone74.ru>
 */

use Longman\TelegramBot\Telegram;
use \Vseprosto\Telegram\Models\TelegramInfoSettings;
use \Longman\TelegramBot\Request;


class TelegramApi
{

    public static $_instance;
    public static $_encoding = 'utf8';

    public static function instance()
    {
        if ( ! self::$_instance) {
            if ( ! TelegramInfoSettings::instance()->get('token')) {
                throw new \Exception('Token not set');
            }

            if ( ! TelegramInfoSettings::instance()->get('name')) {
                throw new \Exception('Bot name not set');
            }

            self::$_instance = new Telegram(
                TelegramInfoSettings::instance()->get('token'),
                TelegramInfoSettings::instance()->get('name')
            );

            $mysql_credentials = [
                'host'      => \Config::get('database.connections.mysql.host'),
                'database'  => \Config::get('database.connections.mysql.database'),
                'user'      => \Config::get('database.connections.mysql.username'),
                'password'  => \Config::get('database.connections.mysql.password'),
            ];
            // TODO
            self::$_instance->enableMySQL($mysql_credentials, 'vseprosto_telegram_', self::$_encoding);

            self::$_instance->addCommandsPaths([
                plugins_path('vseprosto/telegram/commands')
            ]);

            // enable admins
            $admins = [];
            foreach (TelegramInfoSettings::instance()->get('admins') as $i) {
                $admins[] = $i['admin'];
            }
            self::$_instance->enableAdmins($admins);
        }

        return self::$_instance;
    }

    public function sendMessage(array $data)
    {
        return Request::sendMessage($data);
    }
}
