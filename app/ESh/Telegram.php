<?
namespace App\ESh;

class Telegram
{

static $token = '473894957:AAEHMueJdaSYEsQrgCLyx3Mcfz-17Kcs7ew';
static $debugId = '462136229';
static $siteId = 'Resume';
static $url = "http://w48479.hostch01.fornex.org/resume/index.php";

public static function debug($varName, $var){
    CTelegram::sendMessageProxy(self::$debugId,'#'.self::$siteId.'#  '.$varName.' = '.$var);
}


public static function sendMessageProxy($chatID, $message) {
    
    $url = self::$url."?id=".$chatID;
    $url = $url . "&message=". urlencode($message);
    $url = $url . "&code=dRbdqVO1CJLCuAMTAlJ5g1X0KI5nsJsOhTNuBkINQBGUVljo7B";
    
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => true
    );
    
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
       
}

public static function sendFile($chatID, $file) {
    
    $url = self::$url."?id=".$chatID;
    $url = $url . "&file=".($file);
    $url = $url . "&code=g1X0KI5nsJsOVljo7BdRbhTNuBkINQBGUdqVO1CJLCuAMTAlJ5";
    
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => true
    );
    
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
       
}

public static function sendMessage($chatID, $message) {
    
    $url = "https://api.telegram.org/bot".self::$token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($message);
    $url = $url . "&parse_mode=html";
    $url = $url . "&secret=bade527609c35f8a1533f16d91ac4fd3";
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            //CURLOPT_PROXY =>  "80.248.72.115:39880",
            //CURLOPT_PROXY =>  "188.226.141.127:1080",
            CURLOPT_PROXY =>  "31.131.24.131:443",
            CURLOPT_PROXYTYPE => 7,
            CURLOPT_HEADER => 0
    );
    
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

}
?>