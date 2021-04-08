<?
namespace App\ESh;

class Viber
{
    static $url_api = "https://chatapi.viber.com/pa/";

    static $token = "4d2805225ba7dfb7-befe818e8a3dc0af-a925840ff947f77c";

    public static function sendMessage
    (
        $receiver,          // ID администратора Public Account.
        $text           // Текст.
    )
    {
        $data = [];
        $data['receiver']   = $receiver;
        $data['type'] = 'text';
        $data['text']   = $text;
        $data['sender'] = ['name' => "Уведомлятель"];
        
        return self::callApi('send_message', $data);
    }

    public static function sendFile($receiver, $fileName, $fileUrl, $fileSize)
    {
        $data = [];
        $data['receiver']   = $receiver;
        $data['type'] = 'file';
        $data['tracking_data'] = 'tracking_data';
        $data['media'] = $fileUrl;
        $data['size'] = $fileSize;
        $data['file_name'] = $fileName;
        $data['sender'] = ['name' => "Уведомлятель"];
        
        return self::callApi('send_message', $data);
    }

    public static function setup(){
      
      
      $data['url'] = 'https://resume.i-aos.ru/messengers/viber/webhook';
      $data['event_types'] = ['delivered','seen','failed','subscribed', 'unsubscribed', 'conversation_started'];

      return self::callApi('set_webhook', $data);

    }
	
	
    public static function callApi($method, $data)
    {
      
      $url = self::$url_api.$method;
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      $headers = [
        'Content-Type: application/json',
        'X-Viber-Auth-Token: '.self::$token
      ];
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      $result = curl_exec($ch);
      curl_close($ch); 

      return $result;
	  
    }
}