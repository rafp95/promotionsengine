<?php
    
    namespace App\Controller;
    
    use App\Cache\PromotionCache;
    use App\DTO\LowestPriceEnquiry;
    use App\Filter\PromotionsFilterInterface;
    use App\Repository\ProductRepository;
    use App\Repository\PromotionRepository;
    use App\Service\Serializer\DTOSerializer;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    
    class ProductsController extends AbstractController
    {
        
        public function __construct(
            private readonly ProductRepository $productRepository,
            private readonly PromotionRepository $promotionRepository
        )
        {
        }
        
        #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
        public function lowestPrice(
            Request $request,
            int $id,
            DTOSerializer $serializer,
            PromotionsFilterInterface $promotionsFilter,
            PromotionCache $promotionCache
        ): Response
        {
            /**
             * @var LowestPriceEnquiry $lowestPriceEnquiry
             */
            $lowestPriceEnquiry = $serializer->deserialize($request->getContent(), LowestPriceEnquiry::class, "json");
            
            $product = $this->productRepository->findOrFail($id);
            
            $lowestPriceEnquiry->setProduct($product);
            
            $promotions = $promotionCache->findValidProductFromCache($product,$lowestPriceEnquiry->getRequestDate());
           
            
            $modifiedEnquiry = $promotionsFilter->apply($lowestPriceEnquiry, ...$promotions);
            $responseContent = $serializer->serialize($modifiedEnquiry, 'json');
            
            
            $lowestPriceEnquiry->setProduct($product);

            return new Response(
                content: $responseContent,
                status: 200,
                headers: ['Content-Type' => 'application/json']
            );
        }
        
        #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
        public function promotions()
        {
        }
    }