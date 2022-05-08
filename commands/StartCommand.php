<?php

/**
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use Carbon\Carbon;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;
use RainLab\User\Models\User;
use Vseprosto\Telegram\Models\AuthToken;

/**
 * Start command
 */
class StartCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'start';

    /**
     * @var string
     */
    protected $description = 'Start command Custom';

    /**
     * @var string
     */
    protected $usage = '/start';

    /**
     * @var string
     */
    protected $version = '1.2.0';

    /**
     * Command execute method
     *
     * @return ServerResponse
     */
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();

        $chat_id = $message->getChat()->getId();
        $user_id = $message->getFrom()->getId();

        $user = User::where('telegram_id', $user_id)->first();
        if ($user) {
            $data = [
                'chat_id' => $chat_id,
                'text'    => 'Вы связаны с аккаунтом '.$user->username.' на сайте',
            ];

            return Request::sendMessage($data);
        }

        $command_str = trim($message->getText(true));

        if (stripos($command_str, "token_") !== false) {
            $token = str_replace("token_", "", $command_str);

            $obToken = AuthToken::where('token', $token)->first();
            if (empty($obToken)) {
                $data = [
                    'chat_id' => $chat_id,
                    'text'    => 'ошибка, попробуйте еще раз.',
                ];
                return Request::sendMessage($data);
            }
            $time = Carbon::now()->subMinutes(15);
            $tokenTime = $obToken->updated_at?:$obToken->created_at;
            if ($tokenTime < $time) {
                $data = [
                    'chat_id' => $chat_id,
                    'text'    => 'Время истекло',
                ];
                return Request::sendMessage($data);
            }

            $user = User::find($obToken->user_id);
            if ($user) {
                $user->telegram_id = $user_id;
                $user->save();
                $text = 'Пользователь привязан к учетной записи '.$user->username;
            }else {
                $text = 'ошибка';
            }
        }

        $data = [
            'chat_id' => $chat_id,
            'text'    => $text,
        ];

        return Request::sendMessage($data);
    }
}
