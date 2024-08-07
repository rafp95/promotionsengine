<?php
    
    namespace App\Controller;
    
    use App\DTO\LowestPriceEnquiry;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Serializer\SerializerInterface;
    
    class ProductsController extends AbstractController
    {
        #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
        public function lowestPrice(Request $request, int $id, SerializerInterface $serializer): Response
        {
            if ($request->headers->has('force-fail')) {
                return new JsonResponse(
                    data: ['error' => 'Failure message'],
                    status: $request->headers->get('force-fail')
                );
            }
            
            $lowestPriceEnquiry = $serializer->deserialize($request->getContent(), LowestPriceEnquiry::class, "json");
            
            return new JsonResponse(data: [
                "quantity" => 342,
                "request_option" => "UK",
                "voucher_code" => "UOPK32",
                "request_date" => "2023-08-21",
                "product_id" => $id
            ], status: 200);
        }
        
        #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
        public function promotions()
        {
        }
    }