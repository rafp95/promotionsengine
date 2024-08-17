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
            $price = $enquiry->getProduct()->getPrice();
            $quantity = $enquiry->getQuantity();
            $lowestPrice = $quantity * $price;
            
//            $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $enquiry);
            
           
            $enquiry->setDiscountedPrice(250);
            $enquiry->setPrice(100);
            $enquiry->setPromotionId(1);
            $enquiry->setPromotionName($enquiry->getPromotionName());
            
            return $enquiry;
        }
    }