<?php namespace VseProsto\Telegram\Components;

use Cms\Classes\ComponentBase;
use RainLab\User\Models\User;
use Response;
use Vseprosto\Telegram\Models\TelegramInfoSettings;
use Exception;
use Auth;

/**
 * Auth Component
 */
class TelegramAuth extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Auth Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onAuthorization()
    {
        $token = TelegramInfoSettings::instance()->get('token');
        $auth_data = post();
        $check_hash = $auth_data['hash'];
        unset($auth_data['hash']);
        $data_check_arr = [];
        foreach ($auth_data as $key => $value) {
            $data_check_arr[] = $key . '=' . $value;
        }
        sort($data_check_arr);
        $data_check_string = implode("\n", $data_check_arr);
        $secret_key = hash('sha256', $token, true);
        $hash = hash_hmac('sha256', $data_check_string, $secret_key);

        if (strcmp($hash, $check_hash) !== 0) {
            throw new Exception('Data is NOT from Telegram');
        }
        if ((time() - $auth_data['auth_date']) > 86400) {
            throw new Exception('Data is outdated');
        }

        $user = User::where('telegram_id',$auth_data['id'])->first();

        if (empty($user)){
            $user = new User;
            $user->rules['email'] = 'nullable';
            $user->username = $auth_data['username'];

            if (isset($auth_data['first_name'])){
                $user->name = $auth_data['first_name'];
            }
            if (isset($auth_data['last_name'])){
                $user->surname = $auth_data['last_name'];
            }
            $user->telegram_id = $auth_data['id'];

            $user->is_activated = true;
            $user->activated_at = new Carbon;

            $user->password = $user->password_confirmation = Str::random(10);

            $user->save();
        }

        Auth::login($user->reload(), true);

        if (!Auth::check()) {
            return Response::make('Forbidden', 403);
        }

        $test = Auth::getUser();

        return Response::json([], 200);
    }

    public function onGetAuthButton()
    {
        return [
            '#telegram_button' =>
                $this->renderPartial(
                    '@script',
                    []
                )
        ];
    }
}
