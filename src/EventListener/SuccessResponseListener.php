<?php
    
    namespace App\EventListener;
    
    use App\Service\ServiceResponseData;
    use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpKernel\Event\ResponseEvent;
    use Symfony\Component\HttpKernel\KernelEvents;
    
    class SuccessResponseListener implements EventSubscriberInterface
    {
        
        private bool $called = false;
        
        public static function getSubscribedEvents(): array
        {
            return [
                KernelEvents::RESPONSE => 'onResponse'
            ];
        }
        
        public function onResponse(ResponseEvent $responseEvent): void
        {
            if($this->called){
                return;
            }
            
            if($responseEvent->getResponse()->isSuccessful()){
                $response = new ServiceResponseData(
                    data: json_decode($responseEvent->getResponse()->getContent()),
                    error: null
                );
                $responseEvent->setResponse(new JsonResponse(
                    $response->getResponse()
                ));
            }
            
            $this->called = true;
            $responseEvent->stopPropagation();
            
        }
    }