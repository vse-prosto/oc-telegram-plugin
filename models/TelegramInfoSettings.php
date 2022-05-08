<?php namespace Vseprosto\Telegram\Models;
/**
 * This file is part of the Telegram plugin for OctoberCMS.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) Anton Romanov <iam+octobercms@theone74.ru>
 */

use Model;
use Flash;
use Config;
use Vseprosto\Telegram\Classes\TelegramApi;
use Vseprosto\Telegram\Models\User;
use ApplicationException;

/**
 * TelegramInfoSettings Model
 */
class TelegramInfoSettings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    // 	A unique code
    public $settingsCode = 'vseprosto_telegram_info';

    // 	Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $rules = [
        //'name'       => 'required|between:1,16',
        'is_webhook' => 'required|boolean',
        'is_selfsigned' => 'boolean',
        'cert_path'  => 'required_if:is_selfsigned,1|string',
        'token'      => 'required'//|regex:/^[0-9]+:[a-z0-9\-_]+$/i'
    ];

    public $customMessages = [
        'cert_path.required_with_all' => 'vseprosto.telegram::lang.error.cert_path_required'
    ];

    function unparse_url($parsed_url)
    {
        $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
        $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
        $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
        $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
        $pass     = ($user || $pass) ? "$pass@" : '';
        $path     = isset($parsed_url['path']) ? str_replace('//', '/', $parsed_url['path']) : '';
        $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
        $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
        return "$scheme$user$pass$host$port$path$query$fragment";
    }

    function afterSave()
    {
        $url = parse_url(config('app.url'));
        $url['scheme'] = 'https';
        if (!isset($url['path']))
            $url['path'] = '';
        $url['path'] .= '/telehook/'.$this->get('token');
        $url = $this->unparse_url($url);

        $telegram = new TelegramApi($this->get('token'), $this->get('name'));

        if ($this->get('is_webhook')) {

            if ($this->get('is_selfsigned'))
            {
                if (!file_exists($this->get('cert_path')))
                    throw new ApplicationException('Certificate file doesn\'t exist');

                $result = $telegram->setWebHook($url, ['certificate' => $this->get('cert_path')]);
            }
            else {
                $result = $telegram->setWebHook($url);
            }
            if ($result->isOk()) {
                Flash::success($result->getDescription());
            }
        }
        else {
            $result = $telegram->deleteWebhook();
            if ($result->isOk()) {
                Flash::success($result->getDescription());
            }
        }
    }

    public function beforeValidate()
    {
        // $this->rules['admins'] = 'required';
        // 		if you want the repeater to have at least one productItem
        foreach ($this->admins as $index => $Item) {
            $this->rules['admins.'.$index.'.admin'] = 'integer';
            $this->customMessages['admins.'.$index.'.admin.integer'] = 'Admin number '.$index.' needs to be a integer.';
        }
    }

    public function getAdminOptions()
    {
        TelegramUser::all()->lists('username', 'id');
        return TelegramUser::all()->lists('username', 'id');
    }
}
