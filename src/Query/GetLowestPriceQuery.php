<?php
    
    namespace App\Query;
    
    use Symfony\Component\HttpFoundation\Request;
    
    readonly class GetLowestPriceQuery
    {
        public function __construct(
            public Request $request,
            public int $id
        ) {
        }
        
    }