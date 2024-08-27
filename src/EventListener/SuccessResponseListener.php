<?php
    
    namespace App\EventListener;
    
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
                $response =  new JsonResponse([
                    'data' => json_decode($responseEvent->getResponse()->getContent()),
                    'error' => null
                ]);
                $responseEvent->setResponse($response);
            }
            
            $this->called = true;
            $responseEvent->stopPropagation();
            
        }
    }