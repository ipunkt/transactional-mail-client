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
	 * @var int
	 */
	private $request;

	/**
	 * ValidationException constructor.
	 * @param array $data
	 * @param string $request
	 * @param int $code
	 * @param \Exception|null $e
	 */
	public function __construct($data, $request, $code = 0, \Exception $e = null) {
		$this->request = $request;
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

	/**
	 * @return int
	 */
	public function getRequest() {
		return $this->request;
	}

}