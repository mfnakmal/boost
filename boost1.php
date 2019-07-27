<?php
function getStr($a,$b,$data){
$a = @explode($a,$data)[2];
$b = @explode($b,$a)[0];
return $b;
}
function fetch_value($str,$find_start,$find_end) {
	$start = @strpos($str,$find_start);
	if ($start === false) {
		return "";
	}
	$length = strlen($find_start);
	$end    = strpos(substr($str,$start +$length),$find_end);
	return trim(substr($str,$start +$length,$end));
}
function regis($email12,$pass12,$z){
        if($z == "2"){
        $body5 = 'password='.$pass12.'&email='.$email12;
        $ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'http://spinboost.ml:80/v2/login');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body5);
	curl_setopt($ch, CURLOPT_POST, 1);

	$headers = array();
	$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	$headers[] = 'Host: spinboost.ml';
        $headers[] = 'User-Agent: okhttp/3.10.0';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result3 = curl_exec($ch);
	curl_close ($ch);
        $token1 = fetch_value($result3,'"token":"','"');

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'http://spinboost.ml:80/v2/user');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_POST, 1);

	$headers = array();
        $headers[] = 'Authorization: '.$token1;
	$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	$headers[] = 'Host: spinboost.ml';
        $headers[] = 'User-Agent: okhttp/3.10.0';
        $headers[] = 'id: '.$email12;
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	curl_close ($ch);
        $token = fetch_value($result,'"next_spin_result":',',');

        $body1 = 'current_spin_result='.$token.'';
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'http://spinboost.ml:80/v2/user');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
	curl_setopt($ch, CURLOPT_POST, 1);

	$headers = array();
        $headers[] = 'Authorization: '.$token1;
	$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	$headers[] = 'Host: spinboost.ml';
        $headers[] = 'User-Agent: okhttp/3.10.0';
        $headers[] = 'id: '.$email12;
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result1 = curl_exec($ch);
	curl_close ($ch);
        $res = fetch_value($result1,'"message":"','"');
        if($res == 'No spin available.'){
        $ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'http://spinboost.ml:80/v2/user/spin');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
	curl_setopt($ch, CURLOPT_POST, 1);

	$headers = array();
        $headers[] = 'Authorization: '.$token1;
	$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	$headers[] = 'Host: spinboost.ml';
        $headers[] = 'User-Agent: okhttp/3.10.0';
        $headers[] = 'id: '.$email12;
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result3 = curl_exec($ch);
	curl_close ($ch);
        echo "Get Spin wait";
        for($a=1;$a<=3;$a++){
        sleep(2);
        echo ".";
        }
        } else {
        echo "Win : ".fetch_value($res,"Congratulation's you won ",".")." | Spin : ".fetch_value($result1,'"spin":',',')." | Coins : ".fetch_value($result1,'"coin":',',');
        sleep(1);
   }
 } elseif($z == '1') {
        $body5 = 'password='.$pass12.'&email='.$email12;
        $ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'http://spinboost.ml:80/v2/login');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body5);
	curl_setopt($ch, CURLOPT_POST, 1);

	$headers = array();
	$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	$headers[] = 'Host: spinboost.ml';
        $headers[] = 'User-Agent: okhttp/3.10.0';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result3 = curl_exec($ch);
	curl_close ($ch);
        $reff = fetch_value($result3,'"id":"','"');
        $coinreff = getStr('"referral_coin":',',',$result3);

        $get = file_get_contents("https://api.randomuser.me");
	$j = json_decode($get, true);
	$getName = $j['results'][0]['name']['first'];
	$getName2 = $j['results'][0]['name']['last'];
	$rand = rand(0000,9999);
        $rand2 = $getName." ".$getName2;
        $pass = $getName.$rand;
	$email = $getName.$rand."@getnada.com";

        $body1 = 'password='.$pass.'&displayName='.$rand2.'&email='.$email.'';
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'http://spinboost.ml:80/v2/register');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body1);
	curl_setopt($ch, CURLOPT_POST, 1);

	$headers = array();
	$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	$headers[] = 'Host: spinboost.ml';
        $headers[] = 'User-Agent: okhttp/3.10.0';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	curl_close ($ch);

        sleep(3);
        $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://getnada.com/api/v1/inboxes/'.$email);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8';
        $headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 8.1.0; CPH1803 Build/OPM1.171019.026) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.91 Mobile Safari/537.36';
        $headers[] = 'Host: getnada.com';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$res = curl_exec($ch);
	curl_close ($ch);
        $otp = fetch_value($res,'"uid":"','"');

        $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://getnada.com/api/v1/messages/'.$otp);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8';
        $headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 8.1.0; CPH1803 Build/OPM1.171019.026) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.91 Mobile Safari/537.36';
        $headers[] = 'Host: getnada.com';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$res1 = curl_exec($ch);
	curl_close ($ch);
        $otp2 = fetch_value($res1,'<b>','</b>');

        $body2 = 'password='.$pass.'&otp='.$otp2.'&email='.$email.'';
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'http://spinboost.ml:80/v2/verify');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body2);
	curl_setopt($ch, CURLOPT_POST, 1);

	$headers = array();
	$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	$headers[] = 'Host: spinboost.ml';
        $headers[] = 'User-Agent: okhttp/3.10.0';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result1 = curl_exec($ch);
	curl_close ($ch);
        $token = fetch_value($result1,'"token":"','"');

        $body3 = 'referral_code='.$reff.'&itsSkip=false';
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'http://spinboost.ml:80/v2/referral');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body3);
	curl_setopt($ch, CURLOPT_POST, 1);

	$headers = array();
        $headers[] = 'Authorization: '.$token;
        $headers[] = 'id: '.$email;
	$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	$headers[] = 'Host: spinboost.ml';
        $headers[] = 'User-Agent: okhttp/3.10.0';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result2 = curl_exec($ch);
	curl_close ($ch);
        return fetch_value($result2,'"message":"','."')." | Coin : ".$coinreff;
}
}
echo "=============================\n";
echo "CREATOR BY XIZZY404\n";
echo "1. Suntik Reff\n";
echo "2. Suntik Spin & Auto Spin\n";
echo "=============================\n";
echo "Pilih Nomer : ";
$z = trim(fgets(STDIN));
if($z >= '3'){
echo "Pilihan tidak ada\n";
} else {
echo "Jumlah      : ";
$c = trim(fgets(STDIN));
sleep(3);
echo "Silahkan Login\n";
echo "Email lu : ";
$email12 = trim(fgets(STDIN));
echo "Password : ";
$pass12 = trim(fgets(STDIN));
echo "=============================\n";
for($d=1;$d<=$c;$d++){
echo regis($email12,$pass12,$z)."\n";
}
echo "Thx to Xizzy404";
}

