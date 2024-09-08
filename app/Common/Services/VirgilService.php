<?php 

namespace App\Common\Services;
use Illuminate\Http\Request;

use Virgil\Sdk\Api\VirgilApi;
use Virgil\Sdk\Api\VirgilApiContext;
use Virgil\Sdk\Api\AppCredentials;
use Virgil\Sdk\Buffer;

class VirgilService
{
	public function __construct()
	{
	}

	/* For client side */ 
    public function clientToken()
    {
        return $virgilApi = VirgilApi::create(env('VIRGIL_TOKEN'));
    }

	/* For server side */ 
    public function serverToken()
    {
        // For server side
        $virgilApiContext = VirgilApiContext::create(
            [
                // use Application Access Token
                VirgilApiContext::AccessToken => env('VIRGIL_TOKEN'),
                // user Application's credentials for work with Virgil Cards
                VirgilApiContext::Credentials => new AppCredentials(        
                    env('VIRGIL_APPID'),
                    Buffer::fromBase64(env('VIRGIL_APPKEY')),
                    env('VIRGIL_APPPASS')
                ),
            ]
        );
        return $virgilApi = new VirgilApi($virgilApiContext);
    }

    // encrypt the message using User's Virigl Cards
    public function encryptData($userCards, $message)
    {
        $cipherText = $userCards->encrypt($message)->toBase64();

        return $cipherText;
    }

    public function decryptData($key, $enctext)
    {
      $plaintext = $key->decrypt($enctext)->toString();
      return $plaintext;
    }
    
}

?>