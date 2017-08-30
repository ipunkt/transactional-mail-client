<?php namespace Ipunkt\TransactionalMailClient\Exceptions;

/**
 * Class AuthenticationException
 * @package Ipunkt\TransactionalMailClient\Exceptions
 */
class AuthenticationException extends TransactionalMailException {

	/**
	 * @var string
	 */
	private $request;

	/**
	 * @var string
	 */
	private $data;

	/**
	 * AuthenticationException constructor.
	 * @param string $data
	 * @param string $request
	 * @param int $code
	 * @param \Exception|null $exception
	 */
	public function __construct( $data, $request, $code = 0, \Exception $exception = null) {
		$this->request = $request;
		parent::__construct('Authentication failed', $code, $exception);
		$this->data = $data;
	}

	/**
	 * @return string
	 */
	public function getRequest() {
		return $this->request;
	}

	/**
	 * @return string
	 */
	public function getData() {
		return $this->data;
	}

}