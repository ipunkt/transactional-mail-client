<?php namespace Ipunkt\TransactionalMailClient\Exceptions;

/**
 * Class ValidationException
 * @package Ipunkt\TransactionalMailClient\Exceptions
 *
 * Thrown on 422 http status codes which indicate errors in the data
 */
class ValidationException extends TransactionalMailException {
	/**
	 * @var array
	 */
	private $data;
	/**
	 * @var \Exception|null
	 */
	private $e;

	/**
	 * ValidationException constructor.
	 * @param array $data
	 * @param int $code
	 * @param \Exception|null $e
	 */
	public function __construct($data, $code = 0, \Exception $e = null) {
		$this->data = $data;

		$lines = array();
		foreach($data as $field => $error)
			$lines[] = "$field: $error";

		parent::__construct("Validation failed: ".implode(", ", $lines), $code, $e);
	}

	/**
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}

}