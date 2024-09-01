<?php
    
    namespace App\EventListener;
    
    use App\Service\ServiceException;
    use App\Service\ServiceExceptionData;
    use App\Service\ServiceResponseData;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpKernel\Event\ExceptionEvent;
    
    class ExceptionListener
    {
        public function onKernelException(ExceptionEvent $event): void
        {
            $exception = $event->getThrowable();
            
            if($exception instanceof ServiceException){
                $exceptionData = $exception->getExceptionData();
            }else{
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                $exceptionData = new ServiceExceptionData($statusCode, $exception->getMessage());
            }
            
            
            
            $response = new ServiceResponseData(
                data: null,
                error: $exceptionData->toArray()
            );
            
            $event->stopPropagation();
            $event->setResponse(new JsonResponse(
                $response->getResponse()
            ));
        }
    }