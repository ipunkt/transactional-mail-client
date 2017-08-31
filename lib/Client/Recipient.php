<?php namespace Ipunkt\TransactionalMailClient\Client;

/**
 * Class Recipient
 * @package Ipunkt\TransactionalMailClient\TransactionalMailClient
 */
class Recipient {

	/**
	 * @var string
	 */
	protected $email = '';

	/**
	 * @var string
	 */
	protected $name = '';

	public function __construct($email = null, $name = null) {
		if($email === null)
			$email = '';
		if($name === null)
			$name = '';

		$this->email = $email;
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail( $email ) {
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}


}