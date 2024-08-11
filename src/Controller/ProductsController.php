<?php
    
    namespace App\Controller;
    
    use App\DTO\LowestPriceEnquiry;
    use App\Filter\PromotionsFilterInterface;
    use App\Repository\ProductRepository;
    use App\Repository\PromotionRepository;
    use App\Service\Serializer\DTOSerializer;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Serializer\SerializerInterface;
    
    class ProductsController extends AbstractController
    {
        
        public function __construct(
            private readonly ProductRepository $productRepository,
        )
        {
        }
        
        #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
        public function lowestPrice(
            Request $request,
            int $id,
            DTOSerializer $serializer,
            PromotionsFilterInterface $promotionsFilter
        ): Response
        {
            if ($request->headers->has('force-fail')) {
                return new JsonResponse(
                    data: ['error' => 'Failure message'],
                    status: $request->headers->get('force-fail')
                );
            }

            /**
             * @var LowestPriceEnquiry $lowestPriceEnquiry
             */
            $lowestPriceEnquiry = $serializer->deserialize($request->getContent(), LowestPriceEnquiry::class, "json");
            
            $modifiedEnquiry = $promotionsFilter->apply($lowestPriceEnquiry);
            $responseContent = $serializer->serialize($modifiedEnquiry, 'json');
            
            $product = $this->productRepository->find($id);
            
            $lowestPriceEnquiry->setProduct($product);

            return new Response(content: $responseContent, status: 200);
        }
        
        #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
        public function promotions()
        {
        }
    }