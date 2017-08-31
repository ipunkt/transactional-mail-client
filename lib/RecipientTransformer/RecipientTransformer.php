<?php namespace Ipunkt\TransactionalMailClient\RecipientTransformer;
use Ipunkt\TransactionalMailClient\Client\Recipient;

/**
 * Interface RecipientTransformer
 * @package Ipunkt\TransactionalMailClient\TransactionalMailClient\RecipientTransformer
 */
interface RecipientTransformer {

	/**
	 * Transform Recipient object into whatver json data the TransactionalMail service expects
	 *
	 * @param Recipient $recipient
	 * @return mixed
	 */
	function makeRecipientData(Recipient $recipient);

}