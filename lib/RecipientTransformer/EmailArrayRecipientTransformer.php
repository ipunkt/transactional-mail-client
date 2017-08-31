<?php namespace Ipunkt\TransactionalMailClient\RecipientTransformer;

use Ipunkt\TransactionalMailClient\Client\Recipient;

/**
 * Class EmailArrayRecipientTransformer
 * @package Ipunkt\TransactionalMailClient\TransactionalMailClient\RecipientTransformer
 *
 */
class EmailArrayRecipientTransformer implements RecipientTransformer {

	/**
	 * Transform Recipient object into whatver json data the TransactionalMail service expects
	 *
	 * @param Recipient $recipient
	 * @return mixed
	 */
	public function makeRecipientData( Recipient $recipient ) {
		return array( 'email' => $recipient->getEmail() );
	}
}