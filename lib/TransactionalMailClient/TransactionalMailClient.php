<?php namespace Ipunkt\TransactionalMailClient\Exceptions\TransactionalMailClient ;
use Ipunkt\TransactionalMailClient\Exceptions\AuthenticationException;
use Ipunkt\TransactionalMailClient\Exceptions\TransactionalMailException;
use Ipunkt\TransactionalMailClient\Exceptions\ValidationException;

/**
 * Class TransactionalMailClient
 */
class TransactionalMailClient {
	/**
	 * @var string
	 */
	private $url;

	/**
	 * @var string
	 */
	private $username;
	/**
	 * @var string
	 */
	private $password;

	const VERSION_1_0_0 = '1.0.0';

	/**
	 * This is for future compatibility
	 * When the entrypoint format changes a new version  will be added and the new codepath used based on this version
	 * instead of replacing the code and throwing away compatibility with the old version
	 *
	 * @var string
	 */
	private $version;

	/**
	 * TransactionalMailClient constructor.
	 * @param string $url
	 * @param  param string $username
	 * @param param string $password
	 * @param null $version
	 */
	public function __construct( $url = '', $username = '', $password = '', $version = null) {
		if($version === null)
			$version = self::VERSION_1_0_0;

		$this->username = $username;
		$this->password = $password;
		$this->url = $url;
		$this->version = $version;
	}

	/**
	 * @param string $username
	 */
	public function setUsername( string $username ) {
		$this->username = $username;
	}

	/**
	 * @param string $password
	 */
	public function setPassword( string $password ) {
		$this->password = $password;
	}

	/**
	 * @param string $url
	 */
	public function setUrl( string $url ) {
		$this->url = $url;
	}

	/**
	 * @param string $platform
	 * @param string $action
	 * @param array|string $to
	 * @param array $parameters
	 */
	public function send( $platform, $action, $to, $parameters ) {

		if(!is_array($to))
			$to = array($to);
		if( !is_array($parameters) )
			throw new TransactionalMailException('Parameters must be an array');

		$username = $this->username;
		$password = $this->password;
		$url = $this->url;
		$headers = array(
			'Content-Type: application/json',
			'Accept: application/json',
			'Authorization: BASIC '.base64_encode($username.':'.$password),
		);

		$jsonData = json_encode( array(
			'platform' => $platform,
			'action' => $action,
			'to' => $to,
			'parameters' => $parameters
		));

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'POST');
		curl_setopt($ch,CURLOPT_POSTFIELDS,$jsonData);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);

		//execute post
		$result = curl_exec($ch);

		$httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

		if( $httpCode === 401 ) {
			$data = json_decode($result, true);
			throw new AuthenticationException($data);
		}

		if( $httpCode === 422 ) {
			$data = json_decode($result, true);
			throw new ValidationException($data);
		}

		if( $httpCode !== 200 )
			throw new TransactionalMailException('Unkown error while sending: '.$result);
	}

}