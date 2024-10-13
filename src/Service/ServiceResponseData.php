<?php
    
    namespace App\Service;
    
    readonly class ServiceResponseData
    {
        public function __construct(private mixed $data = null, private mixed $error = null)
        {
        
        }
        
        
        public function getResponse(): array
        {
            return [
                'data' => $this->data,
                'error' => $this->error
            ];
        }
        
    }