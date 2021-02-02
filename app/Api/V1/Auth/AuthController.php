<?php

namespace App\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function auth(Request $request)
	{
		$data = [
			'id' => 1,
			'time' => '2021-02-01 16:00:00'
		];

		$token = $this->signEncrypt(json_encode($data), config('api.publicKey'));
		
		$data = $this->signDecrypt($token, config('api.signKey'));
		
	}

	// 加密
    protected function signEncrypt($str, $publicKey)
    {
        $res = "-----BEGIN PUBLIC KEY-----\n" .
            wordwrap($publicKey, 64, "\n", true) .
            "\n-----END PUBLIC KEY-----";
        $dcyCont = "";
        $return_en = openssl_public_encrypt($str, $dcyCont, $res);
        if(!$return_en){
            return false;
        }
        $dcyCont = base64_encode($dcyCont);
        return $dcyCont;
    }
	// 解密
    protected function signDecrypt($str, $signKey)
    {
        $res = "-----BEGIN RSA PRIVATE KEY-----\n" .
            wordwrap($signKey, 64, "\n", true) .
            "\n-----END RSA PRIVATE KEY-----";
        $str = base64_decode($str);
        $dcyCont = "";
        openssl_private_decrypt($str, $dcyCont, $res);
        return $dcyCont;
    }
	
	private function modifyEnv(array $data)
	{
		$envPath = base_path() . DIRECTORY_SEPARATOR . '.env';
		
		$contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));

		$contentArray->transform(function ($item) use ($data){
			
			foreach ($data as $key => $value){
				if(str_contains($item, $key)){
					return $key . '=' . $value;
				}
			}

		return $item;
		});

		$content = implode($contentArray->toArray(), "\n");
		
		\File::put($envPath, $content);
	}
}