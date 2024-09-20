<?php
    
    namespace App\Tests\unit;
    
    use App\Cache\PromotionCache;
    use App\Filter\PromotionsFilterInterface;
    use App\Handler\GetLowestPriceHandler;
    use App\Query\GetLowestPriceQuery;
    use App\Repository\ProductRepository;
    use App\Service\Serializer\DTOSerializer;
    use App\Service\ServiceException;
    use App\Tests\ServiceTestCase;
    use App\Utils\ResponseFromDispatch;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Messenger\Exception\HandlerFailedException;
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
            $this->messageBus = $this->container->get(MessageBusInterface::class);
            
            $params = [
                'id' => 1,
                'requestDate' => "2024-10-01"
            ];
            
            $request = new Request(content: json_encode($params));
            
            $query = new GetLowestPriceQuery($request, 1);
            $result = $this->messageBus->dispatch($query);
            
            $this->assertNotEmpty(ResponseFromDispatch::toResult($result));
        }
        
        public function testHandleException()
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
            $this->messageBus = $this->container->get(MessageBusInterface::class);
            
            $params = [
                'id' => 1,
                'requestDate' => "2024-10-01"
            ];
            
            $request = new Request(content: json_encode($params));
            
            $query = new GetLowestPriceQuery($request, 21);
            $this->expectException(ServiceException::class);
            $this->expectException(HandlerFailedException::class);
            $this->expectExceptionMessage('Product Not Fond');
            
            $this->messageBus->dispatch($query);
        }
    }