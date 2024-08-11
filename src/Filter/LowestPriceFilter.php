<?php
    
    namespace App\Filter;
    
    use App\DTO\PriceEnquiryInterface;
    use App\DTO\PromotionEnquiryInterface;
    
    class LowestPriceFilter implements PromotionsFilterInterface
    {
        
        public function apply(PriceEnquiryInterface $enquiry): PriceEnquiryInterface
        {
            $enquiry->setDiscountedPrice(5);
            $enquiry->setPrice(4);
            $enquiry->setPromotionId(3);
            $enquiry->setPromotionName("dasdas");
            
            return $enquiry;
        }
    }