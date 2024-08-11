<?php
    
    namespace App\Filter;
    
    use App\DTO\PriceEnquiryInterface;
    
    interface PriceFilterInterface extends PromotionsFilterInterface
    {
        public function apply(PriceEnquiryInterface $enquiry): PromotionsFilterInterface;
    }