<?php
    
    namespace App\Tests\unit;
    
    use App\DTO\LowestPriceEnquiry;
    use App\Event\AfterEventDtoCreatedEvent;
    use App\Tests\ServiceTestCase;
    use Psr\EventDispatcher\EventDispatcherInterface;
    use Symfony\Component\Validator\Exception\ValidationFailedException;
    
    class DtoSubscriberTest extends ServiceTestCase
    {
        
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
            $eventDispatcher = $this->container->get('debug.event_dispatcher');
            
            $this->expectException(ValidationFailedException::class);
            $this->expectExceptionMessage('This value should be positive.');
            
            $eventDispatcher->dispatch($event, $event::NAME);
        }
    }