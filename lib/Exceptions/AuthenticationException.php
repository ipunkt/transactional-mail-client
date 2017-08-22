<?php namespace Ipunkt\TransactionalMailClient\Exceptions;

/**
 * Class AuthenticationException
 * @package Ipunkt\TransactionalMailClient\Exceptions
 */
class AuthenticationException extends TransactionalMailException {
	/**
	 * @var \Exception|null
	 */
	private $exception;

	/**
	 * AuthenticationException constructor.
	 * @param int $code
	 * @param \Exception|null $exception
	 */
	public function __construct( $code = 0, \Exception $exception = null) {
		$this->code = $code;
		$this->exception = $exception;
		parent::__construct('Authentication failed', $code, $exception);
	}

}