<?php
    
    namespace App\Tests\unit;
    
    use App\DTO\LowestPriceEnquiry;
    use App\Entity\Promotion;
    use App\Filter\Modifier\DateRangeMultiplier;
    use App\shared\const\PromotionType;
    use App\Tests\ServiceTestCase;
    
    class PriceModifierTest extends ServiceTestCase
    {
        /**
         * @test
         */
        public function DateRangeMultiplier_returns_correctly_modified_price():void
        {
            //Given
            $enquiry = new LowestPriceEnquiry();
            $enquiry->setQuantity(5);
            $enquiry->setRequestDate("2024-01-10");
            
            $promotion = new Promotion();
            $promotion->setName("Black Friday");
            $promotion->setAdjustment(0.5);
            $promotion->setCriteria(["from" => "2024-01-01", "to" => "2024-08-17"]);
            $promotion->setType(PromotionType::DATE_RANGE_MULTIPLIER->value);
            
            
            $dateRangeModifier = new DateRangeMultiplier();
            
            //When
            $modifiedPrice = $dateRangeModifier->modify(100, 5, $promotion, $enquiry);
            
            //Assert
            $this->assertSame(250.0, $modifiedPrice);
        }
    }