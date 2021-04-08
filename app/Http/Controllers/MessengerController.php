<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\ESh\Telegram;
use App\ESh\Viber;

// https://api.telegram.org/bot1649266126:AAHDLr8R-aX3V-MyHg2s9SuM_DTLMxPodp8/setwebhook?url=https://resume.i-aos.ru/messengers/telegram/subscribe

// https://api.telegram.org/bot1649266126:AAHDLr8R-aX3V-MyHg2s9SuM_DTLMxPodp8/getWebhookInfo

class MessengerController extends Controller
{
    public function subscribeTelegram(){

        try{

            $input = json_decode(file_get_contents("php://input"), TRUE);
            
            if($input){
    
                $chatId = $input["message"]["chat"]["id"];
                $message = $input["message"]["text"];
    
                if (strstr($message, "email:")) {
                    
                    $email = explode(':', $message);
                    $user = User::where(['email' => $email[1]])->first();
                    
                    if($user){

                        $userOld = User::where(['telegram' => $chatId])->first();

                        if($userOld){
                            
                            if($userOld->id == $user->id){
                                Telegram::sendMessageProxy($chatId, 'Выбыли подписаны ранее!');
                            }else{
                                Telegram::sendMessageProxy($chatId, 'Данный телеграмм аккаунт уже используется другим пользователем!');
                            }
                            

                        }else{
                            $user->telegram = $chatId;
                            $user->save();
                            Telegram::sendMessageProxy($chatId, 'Вы успешно подписались на уведомления!');
                        }

                        
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
    
        }catch(\Exception $exception){
            \Log::error($exception);
        }

        
        
    }

    public function viberWebhook(){
        
        try{

            $request = file_get_contents("php://input");
            $input = json_decode($request, true);

            if($input){
            
                if($input['event'] == 'webhook') {
                    
                    $webhook_response['status'] = 0;
                    $webhook_response['status_message']="ok";
                    $webhook_response['event_types']='delivered';
                
                }
                else if($input['event'] == "subscribed") {
                    
                    $chatId = $input['sender']['id'];
                    Viber::sendMessage($chatId, [],'Для подписки введите текст email:ваш адрес электронной почты, например: email:ivanov@mail.ru');

                }
                else if($input['event'] == "conversation_started"){
                
                }
                elseif($input['event'] == "message") {

                    $chatId = $input['sender']['id'];
                    $message = $input['message']['text'];

                    if (strstr($message, "email:")) {
                        
                        $email = explode(':', $message);
                        $user = User::where(['email' => $email[1]])->first();
                        
                        if($user){

                            $userOld = User::where(['viber' => $chatId])->first();

                            if($userOld){

                                if($userOld->id == $user->id){
                                    Viber::sendMessage($chatId, [], 'Выбыли подписаны ранее!');
                                }else{
                                    Viber::sendMessage($chatId, [], 'Данный viber аккаунт уже используется другим пользователем!');
                                }
                                
                            }else{
                                $user->viber = $chatId;
                                $user->save();
                                Viber::sendMessage($chatId, [], 'Вы успешно подписались на уведомления!');
                            }
                            
                        }else{
                            Viber::sendMessage($chatId, [],'E-mail не был найден');
                        }

                        
                    }else{
                        Viber::sendMessage($chatId, [],'Не известная команда');
                    }

                    
                
                }elseif($input['event'] == "Failed"){
                    
                }

            }

        }catch(\Exception $exception){
            \Log::error($exception);
        }
        
    }

    public function setupViber(){

        try{
            
            $result = Viber::setup();
            dd($result);

        }catch(\Exception $exception){
            \Log::error($exception);
        }
    }

    

}
