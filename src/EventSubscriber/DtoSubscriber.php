<?php
    
    namespace App\EventSubscriber;
    
    use App\Event\AfterEventDtoCreatedEvent;
    use App\Service\ServiceException;
    use App\Service\ValidationExceptionData;
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
                $validationExceptionData = new ValidationExceptionData(422, 'Validation field.', $errors);
                
                throw new ServiceException($validationExceptionData);
            }
            
        }
        
    }