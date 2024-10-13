<?php
    
    namespace App\Tests\unit;
    
    use App\DTO\LowestPriceEnquiry;
    use App\Entity\Product;
    use App\Entity\Promotion;
    use App\Filter\LowestPriceFilter;
    use App\Shared\Enums\PromotionType;
    use App\Tests\ServiceTestCase;
    
    class LowestPriceFilterTest extends ServiceTestCase
    {
        /**
         * @test
         */
        public function lowest_price_promotions_filtering_is_applied_correctly(): void
        {
            //Given
            $product = new Product();
            $product->setPrice(100);
            
            $enquiry = new LowestPriceEnquiry();
            $enquiry->setProduct($product);
            $enquiry->setQuantity(5);
            $enquiry->setRequestDate("2024-08-17");
            $enquiry->setVoucherCode("CODE_12");
            $enquiry->setPromotionName("Black Friday half price sale");
            $promotions = $this->promotionsDataProvider();
            
            
            //When
            /**
             * @var LowestPriceFilter $lowestPriceFilter
             */
            $lowestPriceFilter = $this->container->get(LowestPriceFilter::class);
            
            
            //Assert
            /**
             * @var LowestPriceEnquiry $filteredEnquiry
             */
            $filteredEnquiry = $lowestPriceFilter->apply($enquiry, ...$promotions);

            $this->assertSame(100.0, $filteredEnquiry->getPrice());
            $this->assertSame('Black Friday 2', $filteredEnquiry->getPromotionName());
            $this->assertSame("CODE_12", $filteredEnquiry->getVoucherCode());
            $this->assertSame(7,$filteredEnquiry->getDiscountedPrice());
        }
        
        public function promotionsDataProvider(): array
        {
            $promotionOne = new Promotion();
            $promotionOne->setName("Black Friday");
            $promotionOne->setAdjustment(0.5);
            $promotionOne->setCriteria(["from" => "2024-01-01", "to" => "2024-08-17"]);
            $promotionOne->setType(PromotionType::DATE_RANGE_MULTIPLIER->value);
            
            $promotionTwo = new Promotion();
            $promotionTwo->setName("Black Friday 2");
            $promotionTwo->setAdjustment(1.5);
            $promotionTwo->setCriteria(["from" => "2024-02-01", "to" => "2024-08-17", "code" => "CODE_12"]);
            $promotionTwo->setType(PromotionType::FIXED_PRICE_VOUCHER->value);
            
            $promotionThree = new Promotion();
            $promotionThree->setName("Black Friday 3");
            $promotionThree->setAdjustment(2.5);
            $promotionThree->setCriteria(["from" => "2024-03-01", "to" => "2024-08-17", "code" => "CODE_13" ]);
            $promotionThree->setType(PromotionType::FIXED_PRICE_VOUCHER->value);
            
            return [$promotionOne, $promotionTwo, $promotionThree];
        }
    }