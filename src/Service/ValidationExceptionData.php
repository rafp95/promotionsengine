<?php
    
    namespace App\Service;

    use Symfony\Component\Validator\ConstraintViolationList;
    
    class ValidationExceptionData extends ServiceExceptionData
    {
        private readonly ConstraintViolationList $violationList;
        
        public function __construct(int $statusCode, string $type, ConstraintViolationList $violationList)
        {
            parent::__construct($statusCode, $type);
            
            $this->violationList = $violationList;
        }
        
        
        public function toArray(): array
        {
            return [
                'type'        => 'ValidationsErrors',
                'errors'  => $this->getViolationsArray()
            ];
        }
        
        public function getViolationsArray():array
        {
            $errors = [];
            
            foreach ($this->violationList as $violation) {
                
                $errors[] = [
                    'propertyPath' => $violation->getPropertyPath(),
                    'message'      => $violation->getMessage()
                ];
            }
            
            return $errors;
        }
        
    }