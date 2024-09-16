<?php
    
    namespace App\Controller;
    
    use App\Query\GetLowestPriceQuery;
    use App\Utils\ResponseFromDispatch;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Messenger\MessageBusInterface;
    use Symfony\Component\Routing\Annotation\Route;
    
    class ProductsController extends AbstractController
    {
        
        public function __construct(
            private readonly MessageBusInterface $queryBus
        )
        {
        }
        
        #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
        public function lowestPrice(
            Request $request,
            int $id,
        ): Response
        {

            $responseContent = $this->queryBus->dispatch(new GetLowestPriceQuery($request, $id));
            
            return new Response(
                content: ResponseFromDispatch::toResult($responseContent),
                status: 200,
                headers: ['Content-Type' => 'application/json']
            );
        }
        
        #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
        public function promotions()
        {
        }
    }