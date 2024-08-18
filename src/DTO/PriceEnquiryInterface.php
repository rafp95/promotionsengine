<?php
    
    namespace App\DTO;
    
    interface PriceEnquiryInterface extends PromotionEnquiryInterface
    {
        public function setPrice(float $price);
        public function setDiscountPrice(float $price);
        public function getQuantity(): ?float;
        
    }