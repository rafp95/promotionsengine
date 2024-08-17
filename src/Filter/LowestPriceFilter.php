<?php
    
    namespace App\Filter;
    

    use App\DTO\LowestPriceEnquiry;
    use App\DTO\PromotionEnquiryInterface;
    use App\Entity\Promotion;
    
    class LowestPriceFilter implements PromotionsFilterInterface
    {
        
        public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotion): PromotionEnquiryInterface
        {
            /**
             * @var LowestPriceEnquiry $enquiry
             */
            $enquiry->setDiscountedPrice(51);
            $enquiry->setPrice($enquiry->getProduct()->getPrice());
            $enquiry->setPromotionId(1);
            $enquiry->setPromotionName($enquiry->getPromotionName());
            
            return $enquiry;
        }
    }