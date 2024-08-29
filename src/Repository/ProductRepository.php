<?php

namespace App\Repository;

use App\Entity\Product;
use App\Service\ServiceException;
use App\Service\ServiceExceptionData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findOrFail(int $id): Product
    {
        $product =  $this->find($id);
        
        if(!$product){
            $exceptionData = new ServiceExceptionData(404, 'Product Not Fond');
            
            throw new ServiceException($exceptionData);
        }
        
        return $product;
    }

}
