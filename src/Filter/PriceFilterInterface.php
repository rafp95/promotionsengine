<?php
    
    namespace App\Filter;
    
    interface PriceFilterInterface extends PromotionsFilterInterface
    {
        public function apply(PriceE $enquiry): PromotionsFilterInterface;
    }