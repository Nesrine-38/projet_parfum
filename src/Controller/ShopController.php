<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/shop')]
class ShopController extends AbstractController
{
    public function __construct(private ShopRepository $shoprep) {}
    #[Route('/shop', name: 'app_shop')]
    #[Route(methods: 'GET')]
    public function All(): JsonResponse
    {
        return $this->json($this->shoprep->findAll());
    }

    #[Route('/{id}', methods: 'GET')]
    public function one(int $id): JsonResponse
    {
        $shop = $this->shoprep->findById($id);
        if ($shop == null) {
            return $this->json('Resource Not Found', 404);

        }
        return $this->json($shop);
    }

    #[Route ('/{id}', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $shop = $this->shoprep->findById($id);
        if ($shop == null) {
            return $this->json('Resource Not Found', 404);

        }
        $this->shoprep->delete($id);

        return $this->json(null, 204);
    }

    #[Route(methods: 'POST')]
    public function add(Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        try {
            $shop = $serializer->deserialize($request->getContent(), Shop::class, 'json');
        } catch (\Exception $error) {
            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($shop);
        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }
        $this->shoprep->persist($shop);
        return $this->json($shop, 201);
    }

    #[Route('/{id}', methods: 'PATCH')]
    public function update(int $id, Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $shop = $this->shoprep->findById($id);
        if ($shop == null) {
            return $this->json('Resource Not Found', 404);
        }        try {
            $serializer->deserialize($request->getContent(), Shop::class, 'json', [
                'object_to_populate' => $shop
            ]);

        } catch (\Exception $error) {

            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($shop);

        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }
        $this->shoprep->update($shop);
        return $this->json($shop, 201);
    }

    #[Route('/{id}/product', methods: 'GET')]
    public function shop(int $id): JsonResponse
    {
        $product = $this->shoprep->findByShop($id);
        if ($product == null) {
            return $this->json('Resource Not Found', 404);

        }
        return $this->json($product);
    }
}
