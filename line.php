<?php

$API_URL = 'https://api.line.me/v2/bot/message/reply';
$ACCESS_TOKEN = 'WjFez4NRiSw3VkGd4q0eMWAcDyJtH5ycqcIffRdyBLDXK3oIRoFtQ/XB+ohzPAuAwubSk0+a1BbEEDT1Q9ovSuxpHkcZa9G8TkXahXzxxs/J06N+H8O16b7Br4yHlakB9zNTQzQy7YgR9DrCU8blPAdB04t89/1O/w1cDnyilFU='; // Access Token ค่าที่เราสร้างขึ้น
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

if ( sizeof($request_array['events']) > 0 )
{

 foreach ($request_array['events'] as $event)
 {
  $reply_message = '';
  $reply_token = $event['replyToken'];

  if ( $event['type'] == 'message' ) 
  {
   
   if( $event['message']['type'] == 'text' )
   {
		$text = $event['message']['text'];
		
		if(($text == "อยากทราบยอด COVID-19 ครับ")||($text == "อยากทราบยอดCOVID-19")||($text == "อยากทราบยอด covid-19 ครับ")){
			$SA = "398,995";
			$DA = "17,365";
			$TA = "103,753";
			$ME = "นายกษิดิศ มากท้วม";
			
			$reply_message = '"รายงานสถานการณ์ ยอดผู้ติดเชื้อไวรัสโคโรนา 2019 (COVID-19) ในประเทศไทย
			ผู้ป่วยสะสม	  จำนวน 425,393 ราย
			ผู้เสียชีวิต	    จำนวน: 18,963 ราย
 			รักษาหาย	จำนวน: 109,191 ราย
 			ผู้รายงานข้อมูล: นายกษิดิศ มากท้วม';
		}
		else if(($text== "ข้อมูลส่วนตัวของผู้พัฒนาระบบ")){
// 			$name = "กษิดิศ มากท้วม";
// 			$age = "22";
// 			$weight = "110";
// 			$tall = "170";
// 			$shz = "9";
			$reply_message = 'ชื่อนายกษิดิศ มากท้วม อายุ 22 ปี น้ำหนัก 110 kg. สูง 170 cm. ขนาดรองเท้าเบอร์ 9.5 US';
		}
		else
		{
			$reply_message = 'ระบบได้รับข้อความ ('.$text.') ของคุณแล้ว';
    		}
   
   }
   else
    $reply_message = 'ระบบได้รับ '.ucfirst($event['message']['type']).' ของคุณแล้ว';
  
  }
  else
   $reply_message = 'ระบบได้รับ Event '.ucfirst($event['type']).' ของคุณแล้ว';
 
  if( strlen($reply_message) > 0 )
  {
   //$reply_message = iconv("tis-620","utf-8",$reply_message);
   $data = [
    'replyToken' => $reply_token,
    'messages' => [['type' => 'text', 'text' => $reply_message]]
   ];
   $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

   $send_result = send_reply_message($API_URL, $POST_HEADER, $post_body);
   echo "Result: ".$send_result."\r\n";
  }
 }
}

echo "OK";

function send_reply_message($url, $post_header, $post_body)
{
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 $result = curl_exec($ch);
 curl_close($ch);

 return $result;
}

?>
