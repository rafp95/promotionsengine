<?php
    
    namespace App\Filter\Modifier;
    
    use App\DTO\PromotionEnquiryInterface;
    use App\Entity\Promotion;
    
    class EventItemsMultiplier implements PriceModifierInterface
    {
        
        public function modify(
            float $price,
            int $quantity,
            Promotion $promotion,
            PromotionEnquiryInterface $enquiry
        ): float {
            if($quantity <= 1){
                return $price * $quantity;
            }
            
            $oddCount = $quantity % 2;
            $eventCount = $quantity - $oddCount;
            
            return (($eventCount * $price) * $promotion->getAdjustment()) + ($oddCount * $price);
        }
    }