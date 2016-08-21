<?php

namespace Wavy\Distext;

use Buzz\Browser;
use Buzz\Message\Response;

class Distext {

    /** @var string */
    private $apiKey;

    /** @var Browser */
    private $browser;

    /**
     * @param $apiKey
     * @param Browser|null $browser
     */
    public function __construct($apiKey, Browser $browser = null)
    {
        $this->apiKey = $apiKey;
        $this->browser = $browser ?: new Browser();
    }

    /**
     * Send a text message
     * @param string $destination
     * @param string $text
     * @throws \Exception
     */
	public function send($destination, $text)
    {
        /** @var Response $response */
        $response = $this->browser->post('http://distext.wavy.be/api/sms', array(
            'X-Auth-Token' => $this->apiKey,
        ), json_encode([
            'destination' => $destination,
            'text' => $text,
        ]));
        
        if(!$response->isSuccessful()) {
            $message = $response->getStatusCode() === 401 ? 'Invalid API key' : $response->getReasonPhrase();
            throw new \Exception($message);
        }
    }
	
}