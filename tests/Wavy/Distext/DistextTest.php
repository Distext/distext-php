<?php

namespace Tests\Wavy\Distext;

use Buzz\Browser;
use Buzz\Message\Response;
use Wavy\Distext\Distext;

class DistextTest extends \PHPUnit_Framework_TestCase
{
    public function testSend()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid API key');

        $response = new Response();
        $response->setHeaders(array(
            'HTTP/1.1 401 Hello from mars',
        ));

        $buzz = $this->getMockBuilder(Browser::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $buzz
            ->expects($this->once())
            ->method('post')
            ->with(
                'http://distext.wavy.be/api/sms',
                array('X-Auth-Token' => 'testApiKey'),
                '{"destination":"0123456789","text":"hello world"}')
            ->willReturn($response);

        $distext = new Distext('testApiKey', $buzz);
        $distext->send('0123456789', 'hello world');
    }
}