<?php 
/**
 * 
 */
class JWT
{

	function __construct()
	{
	}

	function base64UrlEncode($text)
	{
	    return str_replace(
	        ['+', '/', '='],
	        ['-', '_', ''],
	        base64_encode($text)
	    );
	}

	public function generateJWT($data,$iss,$aud,$expiration_time,$secret)
	{
		// Create the token header
		$header = json_encode([
		    'typ' => 'JWT',
		    'alg' => 'HS256'
		]);
		// Create the token payload
		$payload = json_encode([
		    'data' => $data,
			'iss' => $iss,
			'aud' => $aud,
			'iat' => time(),
			'exp' => $expiration_time,
		]);

		// Encode Header
		$base64UrlHeader = $this->base64UrlEncode($header);

		$base64UrlPayload = $this->base64UrlEncode($payload);
		$signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
		$base64UrlSignature = $this->base64UrlEncode($signature);

		return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;	
	}
	
	/**
	 * Validates JWT and returns containing data.
	 * 
	 * @param string $jwt the jwt received from the client.
	 * @param string $iss the name of the issuer
	 * @param string $secret the private key stored in the server
	 * 
	 * @return array Contains a boolean 'error'. And a message indicating the status of the operation.
	 */
	function validateJWT(string $jwt, string $iss, string $secret)
	{
		// split the token
		$tokenParts = explode('.', $jwt);
		$header = base64_decode($tokenParts[0]);
		$payload = base64_decode($tokenParts[1]);
		$signatureProvided = $tokenParts[2];

		$payloadObject = json_decode($payload);
		if($payloadObject->exp < time()){
			return array('error' => true,
						'message'=> 'expired token' );
		}

		if($payloadObject->iss != $iss){
			return array('error' => true,
						'message'=> 'Issuer not matching' );
		}

		// build a signature based on the header and payload using the secret

		$base64UrlHeader = $this->base64UrlEncode($header);
		$base64UrlPayload = $this->base64UrlEncode($payload);
		$signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
		$base64UrlSignature = $this->base64UrlEncode($signature);

		// verify it matches the signature provided in the token
		$signatureValid = ($base64UrlSignature === $signatureProvided);
		if($signatureValid){
			return array('error' => false,
						'message'=> 'Valid Token',
						'data' => $payloadObject->data );
		}
	}
}
 ?>
