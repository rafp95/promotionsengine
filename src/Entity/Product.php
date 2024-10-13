<?php
    
    namespace App\Entity;
    
    use ApiPlatform\Metadata\ApiResource;
    use ApiPlatform\Metadata\Post;
    use App\Controller\ProductsController;
    use App\Repository\ProductRepository;
    use Doctrine\ORM\Mapping as ORM;
    
    #[ORM\Entity(repositoryClass: ProductRepository::class)]
    #[ApiResource(operations: [
        new Post(
            uriTemplate: '/products/{id}/lowest-price',
            controller: ProductsController::class,
            name: 'lowest-price',
        ),
    ])]
    class Product
    {
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null;
        
        #[ORM\Column]
        private ?float $price = null;
        
        public function getId(): ?int
        {
            return $this->id;
        }
        
        public function getPrice(): ?float
        {
            return $this->price;
        }
        
        public function setPrice(float $price): static
        {
            $this->price = $price;
            
            return $this;
        }
        
    }
