<?php
    
    namespace App\Filter\Modifier;
    
    use App\DTO\LowestPriceEnquiry;
    use App\DTO\PromotionEnquiryInterface;
    use App\Entity\Promotion;
    
    class FixedPriceVoucher implements PriceModifierInterface
    {
        
        public function modify(
            float $price,
            int $quantity,
            Promotion $promotion,
            PromotionEnquiryInterface $enquiry
        ): float {
            /**
             * @var LowestPriceEnquiry $enquiry
             */
            if($enquiry->getVoucherCode() === $promotion->getCriteria()['code']){
                return $promotion->getAdjustment() * $quantity;
            }
            
            return $price * $quantity;
        }
    }