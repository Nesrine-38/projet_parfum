<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Repository\OrdersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/orders')]
class OrdersController extends AbstractController
{
    
    public function __construct(private OrdersRepository $ordrep)
    {

    }
    #[Route(methods: 'GET')]
    public function All(): JsonResponse
    {
        return $this->json($this->ordrep->findAll());
    }


    #[Route('/{id}', methods: 'GET')]
    public function one(int $id): JsonResponse
    {
        $orders = $this->ordrep->findById($id);
        if ($orders == null) {
            return $this->json('Resource Not Found', 404);

        }
        return $this->json($orders);
    }


    #[Route('/{id}', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $orders = $this->ordrep->findById($id);
        if ($orders == null) {
            return $this->json('Resource Not Found', 404);

        }
        $this->ordrep->delete($id);

        return $this->json(null, 204);
    }


    #[Route(methods: 'POST')]
    public function add(Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        
        try {
            $orders = $serializer->deserialize($request->getContent(), Orders::class, 'json');
        } catch (\Exception $error) {
            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($orders);
        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }
        $this->ordrep->persist($orders);

        return $this->json($orders, 201);
    }



    #[Route('/{id}', methods: 'PATCH')]
    public function update(int $id, Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $orders = $this->ordrep->findById($id);
        if ($orders == null) {
            return $this->json('Resource Not Found', 404);
        }
        try {
            $serializer->deserialize($request->getContent(), Orders::class, 'json', [
                'object_to_populate' => $orders
            ]);

        } catch (\Exception $error) {

            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($orders);

        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }

        $this->ordrep->update($orders);
        return $this->json($orders, 201);



    }
}

