<?php
namespace App\Helpers;
use Laminas\Crypt\BlockCipher;
use Laminas\Crypt\Symmetric\Openssl;
 
class EncDecHelper{
	public static function enc_string($text){
		$encryptionMethod = 'AES-256-CBC';
		$secretHash = 'XqJJuKW7hEkDJUZkzHaRD4VrPjecVJ8c';
		//$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		$iv = 'abcdefgh12345678';
		$encryptedmobile = openssl_encrypt($text, $encryptionMethod, $secretHash, 0, $iv);
		$encmobile = base64_encode($encryptedmobile);
		return $encmobile;
	}

	public static function dec_string($text){
		$encryptionMethod = 'AES-256-CBC';
		$secretHash = 'XqJJuKW7hEkDJUZkzHaRD4VrPjecVJ8c';
		$iv = 'abcdefgh12345678';
		$dectext = openssl_decrypt(base64_decode($text), $encryptionMethod, $secretHash, 0, $iv);
		return $dectext;
	}

  public static function date_diff_php($start,  $end)
	{
		$sdate = strtotime($start);
		$edate = strtotime($end);
	
		$time = $edate - $sdate;
		if($time>=0 && $time<=59) {
			// Seconds
			$timeshift = $time.' seconds ';
	
		} elseif($time>=60 && $time<=3599) {
			// Minutes + Seconds
			$pmin = ($edate - $sdate) / 60;
			$premin = explode('.', $pmin);
	
			$presec = $pmin-$premin[0];
			$sec = $presec*60;
	
			$timeshift =  '0'.' days '. '0' .' hrs '.$premin[0].' min '.round($sec,0).' sec ';
	
		} elseif($time>=3600 && $time<=86399) {
			// Hours + Minutes
			$phour = ($edate - $sdate) / 3600;
			$prehour = explode('.',$phour);
	
			$premin = $phour-$prehour[0];
			$min = explode('.',$premin*60);
	
			$presec = '0.'.$min[1];
			$sec = $presec*60;
	
			$timeshift = '0'.' days '.$prehour[0].' hrs '.$min[0].' min '.round($sec,0).' sec ';
	
		} elseif($time>=86400) {
			// Days + Hours + Minutes
			$pday = ($edate - $sdate) / 86400;
			$preday = explode('.',$pday);
	
			$phour = $pday-$preday[0];
			$prehour = explode('.',$phour*24);
	
			$premin = ($phour*24)-$prehour[0];
			$min = explode('.',$premin*60);
	
			$presec = '0.'.$min[1];
			$sec = $presec*60;
	
			$timeshift = $preday[0].' days '.$prehour[0].' hrs '.$min[0].' min '.round($sec,0).' sec ';
	
		}
		return $timeshift;
	}
}

   