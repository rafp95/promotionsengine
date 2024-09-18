<?php

namespace App\Tests\unit;

use App\Handler\GetLowestPriceHandler;
use App\Tests\ServiceTestCase;

class GetLowestPriceHandlerTest extends ServiceTestCase
{
    private $handler;
    private $messageBus;

    protected function setUp(): void
    {
        $this->handler = new GetLowestPriceHandler(

        );
        $this->messageBus = $this->createMock(MessageBusInterface::class);
    }

    public function testHandle()
    {
        $query = new GetLowestPriceQuery();
        $envelope = new Envelope($query);

        $this->messageBus->expects($this->once())
            ->method('dispatch')
            ->with($envelope);

        $this->handler->__invoke($query);
    }
}