<?php
    
    namespace App\Controller;
    
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    
    class ProductsController
    {
        #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
        public function lowestPrice(Request $request, int $id): Response
        {
            if ($request->headers->has('force-fail')) {
                return new JsonResponse(
                    data: ['error' => 'Failure message'],
                    status: $request->headers->get('force-fail')
                );
            }
            
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