<?php
    
    namespace App\Tests\unit;
    
    use App\DTO\LowestPriceEnquiry;
    use App\Entity\Product;
    use App\Entity\Promotion;
    use App\Filter\LowestPriceFilter;
    use App\Tests\ServiceTestCase;
    
    class LowestPriceFilterTest extends ServiceTestCase
    {
        /**
         * @test
         */
        public function lowest_price_promotions_filtering_is_applied_correctly(): void
        {
            $product = new Product();
            $product->setPrice(1);
            
            $enquiry = new LowestPriceEnquiry();
            $enquiry->setProduct($product);
            $enquiry->setRequestDate("2024-08-17");
            $enquiry->setVoucherCode("CODE_12");
            $enquiry->setPromotionName("Black Friday half price sale");
            
            $promotions = $this->promotionsDataProvider();
            
            /**
             * @var LowestPriceFilter $lowestPriceFilter
             */
            $lowestPriceFilter = $this->container->get(LowestPriceFilter::class);
            
            /**
             * @var LowestPriceEnquiry $filteredEnquiry
             */
            $filteredEnquiry = $lowestPriceFilter->apply($enquiry, ...$promotions);

            $this->assertSame(1, $filteredEnquiry->getPrice());
            $this->assertSame('Black Friday half price sale', $filteredEnquiry->getPromotionName());
            $this->assertSame("CODE_12", $filteredEnquiry->getVoucherCode());
            $this->assertSame(51,$filteredEnquiry->getDiscountedPrice());
        }
        
        public function promotionsDataProvider(): array
        {
            $promotionOne = new Promotion();
            $promotionOne->setName("Black Friday");
            $promotionOne->setAdjustment(0.5);
            $promotionOne->setCriteria(["from" => "2024-01-01", "to" => "2024-08-17"]);
            $promotionOne->setType("date_range_multiplier");
            
            $promotionTwo = new Promotion();
            $promotionTwo->setName("Black Friday 2");
            $promotionTwo->setAdjustment(1.5);
            $promotionTwo->setCriteria(["from" => "2024-02-01", "to" => "2024-08-17"]);
            $promotionTwo->setType("fixed_price_voucher2");
            
            $promotionThree = new Promotion();
            $promotionThree->setName("Black Friday 3");
            $promotionThree->setAdjustment(2.5);
            $promotionThree->setCriteria(["from" => "2024-03-01", "to" => "2024-08-17"]);
            $promotionThree->setType("fixed_price_voucher3");
            
            return [$promotionOne, $promotionTwo, $promotionThree];
        }
    }