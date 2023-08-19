<?php

namespace App\Controller;

use App\Entity\OrderItem;
use App\Repository\OrderItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/orderitem')]
class OrderItemController extends AbstractController
{

    public function __construct(private OrderItemRepository $orditemrep)
    {

    }
    #[Route(methods: 'GET')]
    public function All(): JsonResponse
    {
        return $this->json($this->orditemrep->findAll());
    }


    #[Route('/{id}', methods: 'GET')]
    public function one(int $id): JsonResponse
    {
        $orditem = $this->orditemrep->findById($id);
        if ($orditem == null) {
            return $this->json('Resource Not Found', 404);

        }
        return $this->json($orditem);
    }


    #[Route('/{id}', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $orditem = $this->orditemrep->findById($id);
        if ($orditem == null) {
            return $this->json('Resource Not Found', 404);

        }
        $this->orditemrep->delete($id);

        return $this->json(null, 204);
    }


    #[Route(methods: 'POST')]
    public function add(Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        
        try {
            $orditem = $serializer->deserialize($request->getContent(), OrderItem::class, 'json');
        } catch (\Exception $error) {
            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($orditem);
        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }
        $this->orditemrep->persist($orditem);

        return $this->json($orditem, 201);
    }



    #[Route('/{id}', methods: 'PATCH')]
    public function update(int $id, Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $orditem = $this->orditemrep->findById($id);
        if ($orditem == null) {
            return $this->json('Resource Not Found', 404);
        }
        try {
            $serializer->deserialize($request->getContent(), OrderItem::class, 'json', [
                'object_to_populate' => $orditem
            ]);

        } catch (\Exception $error) {

            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($orditem);

        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }

        $this->orditemrep->update($orditem);
        return $this->json($orditem, 201);
    }

}
