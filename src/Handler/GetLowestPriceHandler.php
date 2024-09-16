<?php
    
    namespace App\Handler;
    
    use App\Cache\PromotionCache;
    use App\DTO\LowestPriceEnquiry;
    use App\Filter\PromotionsFilterInterface;
    use App\Query\GetLowestPriceQuery;
    use App\Repository\ProductRepository;
    use App\Service\Serializer\DTOSerializer;
    use Symfony\Component\Messenger\Attribute\AsMessageHandler;
    
    
    #[AsMessageHandler]
    readonly class GetLowestPriceHandler
    {
        public function __construct(
            private DTOSerializer $serializer,
            private PromotionsFilterInterface $promotionsFilter,
            private PromotionCache $promotionCache,
            private ProductRepository $productRepository
        ) {
        }
        
        public function __invoke(GetLowestPriceQuery $getLowestPriceQuery)
        {
            /**
             * @var LowestPriceEnquiry $lowestPriceEnquiry
             */
            $lowestPriceEnquiry = $this->serializer->deserialize(
                $getLowestPriceQuery->request->getContent(),
                LowestPriceEnquiry::class,
                "json"
            );
            
            $product = $this->productRepository->findOrFail($getLowestPriceQuery->id);
            
            $lowestPriceEnquiry->setProduct($product);
            
            $promotions = $this->promotionCache->findValidProductFromCache($product, $lowestPriceEnquiry->getRequestDate());
            
            
            $modifiedEnquiry = $this->promotionsFilter->apply($lowestPriceEnquiry, ...$promotions);
            
            return  $this->serializer->serialize($modifiedEnquiry, 'json');
        }
        
        
    }