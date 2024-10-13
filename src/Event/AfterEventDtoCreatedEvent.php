<?php
    
    namespace App\Event;
    
    use App\DTO\PromotionEnquiryInterface;
    use Symfony\Contracts\EventDispatcher\Event;
    
    class AfterEventDtoCreatedEvent extends Event
    {
        public const NAME = 'dto.created';
        
        public function __construct(protected PromotionEnquiryInterface $promotionEnquiry)
        {
        
        }
        
        public function getDto(): PromotionEnquiryInterface
        {
            return $this->promotionEnquiry;
        }
    }