<?php
    
    namespace App\Utils;
    
    use Symfony\Component\Messenger\Envelope;
    use Symfony\Component\Messenger\Stamp\HandledStamp;
    
    class ResponseFromDispatch
    {
        public static function toResult(Envelope $result)
        {
            /** @var HandledStamp|null $handledStamp */
            $handledStamp = $result?->last(HandledStamp::class);
            return $handledStamp?->getResult();
        }
    }