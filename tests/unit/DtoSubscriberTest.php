<?php
    
    namespace App\Tests\unit;
    
    use App\DTO\LowestPriceEnquiry;
    use App\Event\AfterEventDtoCreatedEvent;
    use App\EventSubscriber\DtoSubscriber;
    use App\Service\ServiceException;
    use App\Tests\ServiceTestCase;
    use Psr\EventDispatcher\EventDispatcherInterface;
    
    class DtoSubscriberTest extends ServiceTestCase
    {
        
        
        /**
         * @test
         */
        public function testEventSubscription()
        {
            $this->assertArrayHasKey(AfterEventDtoCreatedEvent::NAME, DtoSubscriber::getSubscribedEvents());
        }
        
        /**
         * @test
         */
        public function a_dto_is_valid_after_it_has_been_created()
        {
            $dto = new LowestPriceEnquiry();
            $dto->setQuantity(-5);
            
            $event = new AfterEventDtoCreatedEvent($dto);
            
            /**
             * @var EventDispatcherInterface $eventDispatcher
             */
            $eventDispatcher = $this->container->get(EventDispatcherInterface::class);
            
            $this->expectException(ServiceException::class);
            $this->expectExceptionMessage('Validation field.');
            
            $eventDispatcher->dispatch($event, $event::NAME);
        }
    }