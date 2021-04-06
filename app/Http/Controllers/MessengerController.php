<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\ESh\Telegram;

// https://api.telegram.org/bot1649266126:AAHDLr8R-aX3V-MyHg2s9SuM_DTLMxPodp8/setwebhook?url=https://resume.i-aos.ru/messengers/telegram/subscribe

// https://api.telegram.org/bot1649266126:AAHDLr8R-aX3V-MyHg2s9SuM_DTLMxPodp8/getWebhookInfo

class MessengerController extends Controller
{
    public function subscribeTelegram(){

        $input = json_decode(file_get_contents("php://input"), TRUE);
        
        if($input){

            $chatId = $input["message"]["chat"]["id"];
            $message = $input["message"]["text"];

            if (strstr($message, "email:")) {
                
                $email = explode(':', $message);
                $user = User::where(['email' => $email[1]])->first();
                
                if($user){
                    $user->telegram = $chatId;
                    $user->save();
                    Telegram::sendMessageProxy($chatId, 'Вы успешно подписались на уведомления!');
                }else{
                    Telegram::sendMessageProxy($chatId, 'E-mail не был найден');
                }

                
            }else{
                Telegram::sendMessageProxy($chatId, 'Не известная команда');
            }

        }else{
            echo 'n/a';
            Telegram::sendMessageProxy('462136229', 'n/a');
        }

        
        
    }

    public function subscribeViber(){

        
        
    }

    

}
