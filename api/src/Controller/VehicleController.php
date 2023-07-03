<?php

namespace App\Controller;

use App\Entity\TechnicalDetail;
use App\Entity\Vehicle;
use App\Services\MakeService;
use App\Services\TechnicalDetailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends AbstractController
{
    #[Route('/api/vehicles/makers', name: 'vehicles_makers_list', methods: ['GET'])]
    public function listMakers(MakeService $vehicleService): JsonResponse
    {
        $makers = $vehicleService->getAllMakers();

        return $this->json($makers);
    }

    #[Route('/api/vehicles/{vehicle}/details', name: 'vehicles_details_list', methods: ['GET'])]
    public function listTechnicalDetailsAction(Vehicle $vehicle): JsonResponse
    {
        return $this->json($vehicle->getTechnicalDetails(), Response::HTTP_OK, [], ['groups' => ['default']]);
    }

    #[Route('/api/vehicles/details/{technicalDetail}', name: 'vehicles_details_update', methods: ['PATCH'])]
    public function updateTechnicalDetailAction(
        Request $request,
        TechnicalDetailService $technicalDetailService,
        TechnicalDetail $technicalDetail
    ): JsonResponse {
        $value = $request->getPayload()->get('value');

        $technicalDetail = $technicalDetailService->updateTechnicalDetail($technicalDetail, $value);

        return $this->json($technicalDetail, Response::HTTP_OK, [], ['groups' => ['default']]);
    }
}
