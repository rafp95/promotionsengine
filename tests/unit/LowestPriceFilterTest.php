<?php
    
    namespace App\Tests\unit;
    
    use App\Filter\LowestPriceFilter;
    use App\Tests\ServiceTestCase;
    
    class LowestPriceFilterTest extends ServiceTestCase
    {
        /**
         * @test
         */
        public function lowest_price_promotions_filtering_is_applied_correctly(): void
        {
            $lowestPriceFilter = $this->container->get(LowestPriceFilter::class);
            
//            $filteredEnquiry = $lowestPriceFilter->apply($enquiry, ...$promotions);
//
//            $enquiry->setDiscountedPrice(5);
//            $enquiry->setPrice(4);
//            $enquiry->setPromotionId(3);
//            $enquiry->setPromotionName("dasdas");
        }
    }