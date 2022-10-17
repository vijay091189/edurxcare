<?php
namespace App\Helpers;

class Helper{

	public static function send_pushnotification($notifications_data,$device_token,$type){  
		//$access_token = 'AAAA5gxK0zo:APA91bHsYUakNY8_A_9lU4Op0BKfbKS5JugtobFyvXkjSGr1jmfEMH4Ig4C-b3cJ5o0OeLJUE2z2lRD-h0naeWq-vSh8PTXHHLpkmqRBujvJ8BvOQHpltAKce9Avp5W_brwK8p9EYjCR';
		if($type=='vendor'){
			//send nofication to vendor apk
			$access_token = 'AAAABhUc0i0:APA91bGCIAiDk0-LwXlIdHZZ-bwnxD3jCrlQ_dhoSthKTM2cTKege-t7n336iaxnj-3oONsnby3bZ4OrPRrEDrUiDdJnllcwzHrcY8GF8sXM5vijHcsUc4y_EoGBEKKgArPBJbjcl6i-'; 
		}else{
			//send notification to customer apk
			$access_token = "AAAA9Rkx_g8:APA91bGZDgTphmkQt_H-AhYkDVYKk8aZcfJHCHaiFxVAfYdbBC7vqEb-_VoLeO9L9herSglU7qIY0ejFwHUy-HzZsxIPWTl5iY3pK8dKsRecT0YeaW-xqu8VK84RmWfdXt9lSkpsp-3A";
		}
		$url = 'https://fcm.googleapis.com/fcm/send';	 
	
		$fields = array(
			'to' => $device_token,
			'data' => $notifications_data,
			'priority' => 'high'
		);    
		
		$headers = array(
			'Authorization: key='.$access_token,
			'Content-Type: application/json'
		);
		
		
		//echo '<pre>';
		//print_r($fields); exit;
		// Open connection
		$responseString='';
		$ch = curl_init();
	
		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$responseString = curl_exec($ch);
		
		//print_r($responseString);  
		 
		if($responseString === false)
		{
			echo 'Curl error: ' . curl_error($ch);
		}  
		return true;
	}   
	
	
	public static function send_grouppushnotification($notifications_data,$device_token){ 

		$folder="HindiWishes2";
			$path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
				$fields = array(
            'condition'=> "'com.rbis_v2' in topics",
            'data' => $notifications_data
        );

        $headers = array(
           'Authorization:key=AAAA_ZykLSA:APA91bGFfGTqvd3ssQHrMDesfYlcr1gL3akYkcM0-8PpWXpi35rohMbeOKHXsLeCgemv9WJEaG1EKyHzhLBKVrP9-2dCj6uIxZLAqLMMSJ8IvsUzcSUblagPZB20VdqZiKDMNtdVWgHu',
            'Content-Type:application/json'
        );		
		$ch = curl_init();
 
        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm); 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    
        $result = curl_exec($ch);
        curl_close($ch);

		return true;
	}  
	
}
?>