<?php namespace Ipunkt\TransactionalMailClient\Exceptions;

/**
 * Class TransactionalMailException
 *
 * Thrown on http status codes other than 200 which do not have a specific exception
 * specific exceptions extend from this so it can be used as a catch-all
 */
class TransactionalMailException extends \RuntimeException {

}