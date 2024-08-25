<?php
    
    namespace App\EventSubscriber;
    
    use App\Event\AfterEventDtoCreatedEvent;
    use App\Service\ServiceException;
    use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Symfony\Component\Validator\Validator\ValidatorInterface;
    
    class DtoSubscriber implements EventSubscriberInterface
    {
        
        
        public function __construct(private readonly ValidatorInterface $validator)
        {
        }
        
        public static function getSubscribedEvents(): array
        {
            return [
                AfterEventDtoCreatedEvent::NAME => 'validateDto'
            ];
        }
        
        public function validateDto(AfterEventDtoCreatedEvent $event): void
        {
            $dto = $event->getDto();
            
            $errors = $this->validator->validate($dto);
            
            if(count($errors) > 0){
                throw new ServiceException(422, 'Validation field');
            }
            
        }
        
    }