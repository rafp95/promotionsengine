<?php
    
    namespace App\Filter\Modifier;
    
    use App\DTO\LowestPriceEnquiry;
    use App\DTO\PromotionEnquiryInterface;
    use App\Entity\Promotion;
    use App\shared\Enums\PromotionType;
    
    class DateRangeMultiplier implements PriceModifierInterface
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
            if($promotion->getType() === PromotionType::DATE_RANGE_MULTIPLIER->value){
                $requestDate = date_create($enquiry->getRequestDate());
                $from = date_create($promotion->getCriteria()['from']);
                $to = date_create($promotion->getCriteria()['to']);
                
                if($requestDate >= $from && $requestDate <= $to){
                    return ($price * $quantity) * $promotion->getAdjustment();
                }
            }
            
            
            
            return ($price * $quantity);
        }
    }