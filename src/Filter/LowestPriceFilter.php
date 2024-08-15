<?php
    
    namespace App\Filter;
    
    use App\DTO\PromotionEnquiryInterface;
    use App\Entity\Promotion;
    
    class LowestPriceFilter implements PromotionsFilterInterface
    {
        
        public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotion): PromotionEnquiryInterface
        {
            $enquiry->setDiscountedPrice(5);
            $enquiry->setPrice(4);
            $enquiry->setPromotionId(3);
            $enquiry->setPromotionName("dasdas");
            
            return $enquiry;
        }
    }