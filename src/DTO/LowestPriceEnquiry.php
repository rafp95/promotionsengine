<?php
    
    namespace App\DTO;
    
    use App\Entity\Product;
    
    class LowestPriceEnquiry implements PriceEnquiryInterface
    {
        #region Props
        private ?Product $product;
        private ?string $requestLocation;
        private ?string $voucherCode;
        private ?string $requestDate;
        private ?float $price;
        private ?int $discountedPrice;
        private ?int $promotionId;
        private ?string $promotionName;
        #endregion
        
        #region Getter / Setter
 
        
        public function getRequestLocation(): ?string
        {
            return $this->requestLocation;
        }
        
        public function setRequestLocation(?string $requestLocation): void
        {
            $this->requestLocation = $requestLocation;
        }
        
        public function getVoucherCode(): ?string
        {
            return $this->voucherCode;
        }
        
        public function setVoucherCode(?string $voucherCode): void
        {
            $this->voucherCode = $voucherCode;
        }
        
        public function getRequestDate(): ?string
        {
            return $this->requestDate;
        }
        
        public function setRequestDate(?string $requestDate): void
        {
            $this->requestDate = $requestDate;
        }
        
        public function getPrice(): ?int
        {
            return $this->price;
        }
        
        public function setPrice(?float $price): void
        {
            $this->price = $price;
        }
        
        public function getDiscountedPrice(): ?int
        {
            return $this->discountedPrice;
        }
        
        public function setDiscountedPrice(?int $discountedPrice): void
        {
            $this->discountedPrice = $discountedPrice;
        }
        
        public function getPromotionId(): ?int
        {
            return $this->promotionId;
        }
        
        public function setPromotionId(?int $promotionId): void
        {
            $this->promotionId = $promotionId;
        }
        
        public function getPromotionName(): ?string
        {
            return $this->promotionName;
        }
        
        public function setPromotionName(?string $promotionName): void
        {
            $this->promotionName = $promotionName;
        }
        #endregion
        
        public function getProduct(): ?Product
        {
            return $this->product;
        }
        
        public function setProduct(?Product $product): void
        {
            $this->product = $product;
        }
    }