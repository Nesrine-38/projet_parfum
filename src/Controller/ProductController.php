<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/product')]
class ProductController extends AbstractController
{
        public function __construct(private ProductRepository $proprep){}

    #[Route(methods: 'GET')]
    public function All(): JsonResponse
    {
        return $this->json($this->proprep->findAll());
    }

    #[Route('/{id}', methods: 'GET')]
    public function one(int $id): JsonResponse
    {
        $product = $this->proprep->findById($id);
        if ($product == null) {
            return $this->json('Resource Not Found', 404);

        }
        return $this->json($product);
    }


    #[Route('/{id}', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $product = $this->proprep->findById($id);
        if ($product == null) {
            return $this->json('Resource Not Found', 404);

        }
        $this->proprep->delete($id);

        return $this->json(null, 204);
    }


    #[Route(methods: 'POST')]
    public function add(Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        
        try {
            $product = $serializer->deserialize($request->getContent(), Product::class, 'json');
        } catch (\Exception $error) {
            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($product);
        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }
        $this->proprep->persist($product);

        return $this->json($product, 201);
    }



    #[Route('/{id}', methods: 'PATCH')]
    public function update(int $id, Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $product = $this->proprep->findById($id);
        if ($product == null) {
            return $this->json('Resource Not Found', 404);
        }
        try {
            $serializer->deserialize($request->getContent(), Product::class, 'json', [
                'object_to_populate' => $product
            ]);

        } catch (\Exception $error) {

            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($product);

        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }

        $this->proprep->update($product);
        return $this->json($product, 201);



    }
}
