<?php
    
    namespace App\DTO;
    
    use App\Entity\Product;
    use Symfony\Component\Serializer\Annotation\Ignore;
    
    class LowestPriceEnquiry implements PriceEnquiryInterface
    {
        #region Props
        #[Ignore]
        private ?Product $product;
        private ?int $quantity = 1;
        private ?string $requestLocation;
        private ?string $voucherCode;
        private ?string $requestDate;
        private ?float $price;
        private ?int $discountedPrice;
        private ?int $promotionId;
        private ?string $promotionName;
        
        #endregion
        
        public function getProduct(): ?Product
        {
            return $this->product;
        }
        
        public function setProduct(?Product $product): LowestPriceEnquiry
        {
            $this->product = $product;
            return $this;
        }
        
        public function getQuantity(): ?int
        {
            return $this->quantity;
        }
        
        public function setQuantity(?int $quantity): LowestPriceEnquiry
        {
            $this->quantity = $quantity;
            return $this;
        }
        
        public function getRequestLocation(): ?string
        {
            return $this->requestLocation;
        }
        
        public function setRequestLocation(?string $requestLocation): LowestPriceEnquiry
        {
            $this->requestLocation = $requestLocation;
            return $this;
        }
        
        public function getVoucherCode(): ?string
        {
            return $this->voucherCode;
        }
        
        public function setVoucherCode(?string $voucherCode): LowestPriceEnquiry
        {
            $this->voucherCode = $voucherCode;
            return $this;
        }
        
        public function getRequestDate(): ?string
        {
            return $this->requestDate;
        }
        
        public function setRequestDate(?string $requestDate): LowestPriceEnquiry
        {
            $this->requestDate = $requestDate;
            return $this;
        }
        
        public function getPrice(): ?float
        {
            return $this->price;
        }
        
        public function setPrice(?float $price): LowestPriceEnquiry
        {
            $this->price = $price;
            return $this;
        }
        
        public function getDiscountedPrice(): ?int
        {
            return $this->discountedPrice;
        }
        
        public function setDiscountedPrice(?int $discountedPrice): LowestPriceEnquiry
        {
            $this->discountedPrice = $discountedPrice;
            return $this;
        }
        
        public function getPromotionId(): ?int
        {
            return $this->promotionId;
        }
        
        public function setPromotionId(?int $promotionId): LowestPriceEnquiry
        {
            $this->promotionId = $promotionId;
            return $this;
        }
        
        public function getPromotionName(): ?string
        {
            return $this->promotionName;
        }
        
        public function setPromotionName(?string $promotionName): LowestPriceEnquiry
        {
            $this->promotionName = $promotionName;
            return $this;
        }
        
    }