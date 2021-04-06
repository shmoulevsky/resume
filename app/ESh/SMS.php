<? 
namespace App\ESh;

class SMS
{
	public static $app_id = '965a5db7-eeb7-36a4-7d0f-c8f5171a0b7f';
	public static function send($number, $text){
			
		
		$app_id = self::$app_id;
		
		$ch = curl_init("http://sms.ru/sms/send");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(

			"api_id"		=>	$app_id,
			"to"			=>	$number,
			"text"		=>	$text

		));
		$body = curl_exec($ch);
		curl_close($ch);
		
		       
				
	}
	
	public static function getBalance(){
		
		$app_id = self::$app_id;
		
		$ch = curl_init("http://sms.ru/my/balance");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(

			"api_id"		=>	$app_id

		));
		$body = curl_exec($ch);
		curl_close($ch);

		list($code,$balance) = explode("\n", $body);
		if ($code=="100") {
			echo $balance;
		} else {
			echo 'error-'.$code;
		}
	}
	
		
}
?>