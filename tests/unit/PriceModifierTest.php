<?php
    
    namespace App\Tests\unit;
    
    use App\DTO\LowestPriceEnquiry;
    use App\Entity\Promotion;
    use App\Filter\Modifier\DateRangeMultiplier;
    use App\Filter\Modifier\EventItemsMultiplier;
    use App\Shared\Enums\PromotionType;
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
        
        /**
         * @test
         */
        public function EventItemsMultiplierReturnsCorrectlyModifiedPrice(): void
        {
            // Given
            $enquiry = new LowestPriceEnquiry();
            $enquiry->setQuantity(5);
            
            $promotion = new Promotion();
            $promotion->setName("Buy one get one free");
            $promotion->setAdjustment(0.5);
            $promotion->setCriteria(['minimum_quantity' => 2]);
            $promotion->setType(PromotionType::EVEN_ITEMS_MULTIPLIER->value);
            
            $evenItemsMultiplier = new EventItemsMultiplier();
            
            //When
            
            $modifiedPrice = $evenItemsMultiplier->modify(100,5,$promotion,$enquiry);
            
            $this->assertSame(300.0,$modifiedPrice);
        }
        
        /**
         * @test
         */
        public function EventItemsMultiplierCorrectlyCalculatesAlternatives(): void
        {
            // Given
            $enquiry = new LowestPriceEnquiry();
            $enquiry->setQuantity(5);
            
            $promotion = new Promotion();
            $promotion->setName("Buy one get half free");
            $promotion->setAdjustment(0.75);
            $promotion->setCriteria(['minimum_quantity' => 2]);
            $promotion->setType(PromotionType::EVEN_ITEMS_MULTIPLIER->value);
            
            $evenItemsMultiplier = new EventItemsMultiplier();
            
            //When
            
            $modifiedPrice = $evenItemsMultiplier->modify(100,5,$promotion,$enquiry);
            
            $this->assertSame(400.0,$modifiedPrice);
        }
        
    }