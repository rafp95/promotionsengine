<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model;
use App\Controller\ProductsController;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(operations: [
    new Post(
        uriTemplate: '/products/{id}/lowest-price',
        status: Response::HTTP_OK,
        controller: ProductsController::class,
        openapi: new Model\Operation(
            responses: [
                '200' => [
                    'description' => 'promo cods'
                ],
            ],
            summary: 'Get lowest price product',
            description: '',
            requestBody: new Model\RequestBody(
                content: new \ArrayObject([
                    'application/json' => [
                        'schema' => [
                            'type' => 'object',
                            'properties' => [
                                'requestDate' => ['type' => 'string'],
                            ]
                        ],
                        'example' => [
                            'requestDate' => '2024-10-01',
                        ]
                    ]
                ])
            )
        ),
        name: 'lowest-price'
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
