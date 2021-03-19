<?php

namespace App\Controller;

use App\Entity\AssetTanahPerusahaan;
use App\Entity\AssetTanahPribadi;
use App\Repository\AssetKendaraanMobilRepository;
use App\Repository\AssetKendaraanMotorRepository;
use App\Repository\AssetTanahPerusahaanRepository;
use App\Repository\AssetTanahPribadiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/GetKendaraanByManufaktur", name="GetKendaraanByManufaktur", methods={"GET","POST"})
     */
    public function Dashboard1(SerializerInterface $serializer,AssetKendaraanMobilRepository $assetKendaraanMobilRepo, AssetKendaraanMotorRepository $assetKendaraanMotorRepo): Response
    {
        $dataMotor = $assetKendaraanMotorRepo->findMotorByManufacturer();
        $dataMobil =  $assetKendaraanMobilRepo->findMobilByManufacturer();
        
        $data = $serializer->serialize(array_merge($dataMobil,$dataMotor),  'json');
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    
    /**
     * @Route("/GetLuasanPerDesa", name="GetLuasanPerDesa", methods={"GET","POST"})
     */
    public function Dashboard2(SerializerInterface $serializer,AssetTanahPerusahaanRepository $assetTanahPerusahaanRepo, AssetTanahPribadiRepository $assetTanahPribadiRepo): Response
    {
        $dataPerusahaan = $assetTanahPerusahaanRepo->getLuasanPerDesa();
        $dataPribadi =  $assetTanahPribadiRepo->getLuasanPerDesa();
        
        $data = $serializer->serialize(array_merge($dataPerusahaan,$dataPribadi),  'json');
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
