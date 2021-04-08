<?
namespace App\ESh;

class Telegram
{

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


}
?>