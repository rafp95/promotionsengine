<?php

namespace App\Tests\unit;

use App\Cache\PromotionCache;
use App\Filter\PromotionsFilterInterface;
use App\Repository\ProductRepository;
use App\Tests\ServiceTestCase;
use App\Handler\GetLowestPriceHandler;
use App\Query\GetLowestPriceQuery;
use App\Service\Serializer\DTOSerializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class GetLowestPriceHandlerTest extends ServiceTestCase
{
    private $handler;
    private $messageBus;

    public function testHandle()
    {

        $serializer = $this->container->get(DTOSerializer::class);
        $promotionsFilter = $this->container->get(PromotionsFilterInterface::class);
        $promotionCache = $this->container->get(PromotionCache::class);
        $productRepository = $this->container->get(ProductRepository::class);

        $this->handler = new GetLowestPriceHandler(
            $serializer,
            $promotionsFilter,
            $promotionCache,
            $productRepository,
        );
        $this->messageBus = $this->createMock(MessageBusInterface::class);



        $params = [
            'id' => 1,
            'requestDate' => "2024-10-01"
        ];

        $request = new Request(content: json_encode($params));



        $query = new GetLowestPriceQuery($request, 1);
        $result = $this->handler->__invoke($query);

        $this->assertNotEmpty($result);
    }
}