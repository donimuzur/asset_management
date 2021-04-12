<?php

namespace App\Controller;

use App\Entity\AssetBangunanPribadi;
use App\Entity\AttachmentAssetBangunanPribadi;
use App\Entity\StatusPembayaranBangunanPribadi;
use App\Form\AssetBangunanPribadiType;
use App\Repository\AssetBangunanPribadiRepository;
use App\Repository\MasterWilayahRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/Asset/Bangunan/Pribadi")
 */
class AssetBangunanPribadiController extends AbstractController
{
    /**
     * @Route("/", name="asset_bangunan_pribadi_index", methods={"GET","POST"})
     */
    public function index(Request $request, AssetBangunanPribadiRepository $assetBangunanPribadiRepository): Response
    {
        $submittedToken = $request->request->get('_token');
        $search_desa = $request->request->get('search_desa');
        $ListData = null;
        if ($request->isMethod('POST') && $this->isCsrfTokenValid('AttachmentAssetBangunanPribadi', $submittedToken)) {

            $ListData = $assetBangunanPribadiRepository->findFilterAll($search_desa);
            if(is_null($search_desa) || empty($search_desa))
            {
                $ListData = $assetBangunanPribadiRepository->findAllSorted();
            }
            
            return $this->render('asset_bangunan_pribadi/index.html.twig', [
                'asset_bangunan_pribadis' => $ListData
            ]);
            
        }
        
        return $this->render('asset_bangunan_pribadi/index.html.twig', [
            'asset_bangunan_pribadis' => $assetBangunanPribadiRepository->findAllSorted(),
        ]);
    }

    /**
     * @Route("/New", name="asset_bangunan_pribadi_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $assetBangunanPribadi = new AssetBangunanPribadi();
        $form = $this->createForm(AssetBangunanPribadiType::class, $assetBangunanPribadi);
        $form->handleRequest($request);
        $getId = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($assetBangunanPribadi);
            $entityManager->flush();
            $getId = $assetBangunanPribadi->getId();

            $this->addFlash(
                'success',
                'Success, data were saved!'
            );

            return $this->redirectToRoute('asset_bangunan_pribadi_edit',['id'=>$getId]);
        }

        return $this->render('asset_bangunan_pribadi/new.html.twig', [
            'asset_bangunan_pribadi' => $assetBangunanPribadi,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/UpdateAttachment", name="asset_bangunan_pribadi_update_attachment", methods={"POST"})
     */
    public function update(Request $request, SluggerInterface $slugger): Response
    {
        $isNew = false;
        $AttachmentId = $request->request->get('AttachmentId');
        $Description = $request->request->get('description');
        $AssetBangunanPribadiId = $request->request->get('AssetBangunanPribadiId');
        $submittedToken = $request->request->get('_token');
        $uFile = $request->files->get('ufile');

        if ($request->isMethod('POST') && $this->isCsrfTokenValid('AttachmentAssetBangunanPribadi', $submittedToken)) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $AssetBangunanPribadi =  $this->getDoctrine()
                ->getRepository(AssetBangunanPribadi::class)
                ->find($AssetBangunanPribadiId);

            $AttachmentAssetBangunanPribadi = $this->getDoctrine()
                ->getRepository(AttachmentAssetBangunanPribadi::class)
                ->find($AttachmentId);

            if(!$AttachmentAssetBangunanPribadi)
            {
                $isNew = true;
                $AttachmentAssetBangunanPribadi = new AttachmentAssetBangunanPribadi();
            }

            if ($uFile) {
                $originalFilename = pathinfo($uFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = uniqid().'.'.$uFile->guessExtension();
                $content = file_get_contents($uFile);
                $filType = $uFile->gettype();

                $AttachmentAssetBangunanPribadi  ->setAttachSize($uFile->getSize())
                                              ->setAttachedTime(new \DateTime('now'))
                                              ->setAttachFilename($newFilename)
                                              ->setAttachedBy($this->getUser())
                                              ->setAttachType($filType);
            }

            $AttachmentAssetBangunanPribadi->setAssetBangunanPribadi($AssetBangunanPribadi)
                                            ->setAttachDesc($Description);
            if($isNew)
            {
                $entityManager->persist($AttachmentAssetBangunanPribadi);
            }
            
            $entityManager->flush();
            $uFile->move(
                $this->getParameter('app.attachment_dir').'/AssetBangunanPribadi',
                $newFilename
            );
            $this->addFlash(
                'success',
                'Attachment were uploaded!'
            );
        }
       
        return $this->redirectToRoute('asset_bangunan_pribadi_edit',['id'=>$AssetBangunanPribadiId]);
    }
    
      /**
     * @Route("/DeleteAttachment", name="asset_bangunan_pribadi_attacment_delete", methods={"DELETE"})
     */
    public function deleteAttachment(Request $request): Response
    {
        $attachmentsToDelete = $request->request->get('chkAssetBangunan');
        $AssetBangunanPribadiId = $request->request->get('AssetBangunanPribadiId');

        if ($this->isCsrfTokenValid('delete', $request->request->get('_token'))) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            
            foreach($attachmentsToDelete as $attachmentsToDelete)
            {
                    $AttachmentObjectToDelete  =  $this->getDoctrine()
                    ->getRepository(AttachmentAssetBangunanPribadi::class)
                    ->find($attachmentsToDelete); 

                    $entityManager->remove($AttachmentObjectToDelete);
            }

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Attachment deleted'            
            );
            
        }

        return $this->redirectToRoute('asset_bangunan_pribadi_edit',['id'=>$AssetBangunanPribadiId]);
    }


    /**
     * @Route("/View/{id}", name="asset_bangunan_pribadi_show", methods={"GET"})
     */
    public function show(AssetBangunanPribadi $assetBangunanPribadi): Response
    {
        return $this->render('asset_bangunan_pribadi/show.html.twig', [
            'asset_bangunan_pribadi' => $assetBangunanPribadi,
        ]);
    }

  
    /**
     * @Route("/Edit/{id}", name="asset_bangunan_pribadi_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AssetBangunanPribadi $assetBangunanPribadi): Response
    {
        $form = $this->createForm(AssetBangunanPribadiType::class, $assetBangunanPribadi);
        $form->handleRequest($request);
       
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('asset_bangunan_pribadi_edit',['id'=>$assetBangunanPribadi->getId()]);
        }
        
        return $this->render('asset_bangunan_pribadi/edit.html.twig', [
            'asset_bangunan_pribadi' => $assetBangunanPribadi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Delete", name="asset_bangunan_pribadi_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $assetBangunanPribadiToDelete = $request->request->get('chkAssetBangunan');

        if ($this->isCsrfTokenValid('delete', $request->request->get('_token'))) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            
            foreach($assetBangunanPribadiToDelete as $assetBangunanPribadiToDelete)
            {
                    $AttachmentObjectToDelete  =  $this->getDoctrine()
                    ->getRepository(AssetBangunanPribadi::class)
                    ->find($assetBangunanPribadiToDelete); 

                    $entityManager->remove($AttachmentObjectToDelete);
            }

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Success, Data were deleted'        
            );
            
        }

        return $this->redirectToRoute('asset_bangunan_pribadi_index');
    }

    /**
     * @Route("/DownloadAttachment/{AssetBangunanPribadiId}/{id}", name="asset_bangunan_pribadi_download_attachment",methods={"GET","POST"})
     */
    public function downloadAttachment(Request $request, int $id, int $AssetBangunanPribadiId): Response
    {
        // $AssetBangunanPribadiId = $request->request->get('AssetBangunanPribadiId');
        // $attachmentId = $request->request->get('id');
        $AttachmentFile  =  $this->getDoctrine()
            ->getRepository(AttachmentAssetBangunanPribadi::class)
            ->find($id); 
        
        if (!empty($AttachmentFile)) {

            $file = $this->getParameter('app.attachment_dir').'\/AssetBangunanPribadi\/'.$AttachmentFile->getAttachFilename();
            
            $fileType = $AttachmentFile->getAttachType(); 
            $fileSize = $AttachmentFile->getAttachSize(); 
            $fileName = $AttachmentFile->getAttachFilename(); 
            
            $response = new BinaryFileResponse($file);
            $response->headers->set('Expires', '0');
            $response->headers->set("Cache-Control", "must-revalidate, post-check=0, pre-check=0, max-age=0");
            $response->headers->set("Cache-Control", "private", false);
            $response->headers->set("Content-Type", $fileType);
            $response->headers->set("Content-Disposition", 'attachment; filename="' . $fileName . '";');
            $response->headers->set("Content-Transfer-Encoding", "binary");
            $response->headers->set("Content-Length", $fileSize);

            return $response;
        } else {
            return $this->redirectToRoute('asset_bangunan_pribadi_edit',['id'=>$AssetBangunanPribadiId]);
        }
    }

     /**
     * @Route("/GetDataProvinsiList/", name="asset_bangunan_pribadi_getDataProvinsiList", methods={"GET","POST"})
     */
    public function GetDataProvinsiList(Request $request, SerializerInterface $serializer, MasterWilayahRepository $masterWilayahRepository): JsonResponse
    {
        $models = $masterWilayahRepository->getProvinsiList();
        $data = $serializer->serialize($models,  'json');
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
    
    /**
     * @Route("/GetDataMadyaList/{provinsiId}", name="asset_bangunan_pribadi_getDataMadyaList", methods={"GET","POST"})
     */
    public function GetDataMadyaList(Request $request,string $provinsiId, SerializerInterface $serializer, MasterWilayahRepository $masterWilayahRepository): JsonResponse
    {
        $models = $masterWilayahRepository->getMadyaList($provinsiId);
        $data = $serializer->serialize($models,  'json');
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/GetDataKecamatanList/{madyaId}", name="asset_bangunan_pribadi_getDataKecamatanList", methods={"GET","POST"})
     */
    public function GetDataKecamatanList(Request $request, string $madyaId, SerializerInterface $serializer, MasterWilayahRepository $masterWilayahRepository): JsonResponse
    {
        $models = $masterWilayahRepository->getKecamatanList($madyaId);
        $data = $serializer->serialize($models,  'json');
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

     /**
     * @Route("/GetDataDesaList/{kecId}", name="asset_bangunan_pribadi_getDataDesaList", methods={"GET","POST"})
     */
    public function GetDataDesaList(Request $request, string $kecId, SerializerInterface $serializer, MasterWilayahRepository $masterWilayahRepository): JsonResponse
    {
        $models = $masterWilayahRepository->getDesaList($kecId);
        $data = $serializer->serialize($models,  'json');
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    
    /**
     * @Route("/GetDataDesaFilter", name="asset_bangunan_pribadi_getDataDesaFilterList", methods={"GET","POST"})
     */
    public function GetDataDesaFilterList(SerializerInterface $serializer, AssetBangunanPribadiRepository $assetBangunanPribadiRepository): JsonResponse
    {
        $models = $assetBangunanPribadiRepository->getDataDesaList();
        $data = $serializer->serialize($models,  'json');
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/ExportToXls/", name="asset_bangunan_pribadi_export", methods={"GET","POST"})
     */
    public function ExportToXls(Request $request, AssetBangunanPribadiRepository $assetBangunanPribadiRepository): Response
    {

        $submittedToken = $request->request->get('_token');
        $search_desa = $request->request->get('search_desa_export');
        $ListData = null;
        if ($request->isMethod('POST') && $this->isCsrfTokenValid('export_token', $submittedToken)) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            
            $sheet->setCellValue("A1","Nama Desa : ".$search_desa);

            $header = array("No","Nomor Hak","Luas(m2)","Nama Pemilik","Status & Keterangan");
            $sheet->fromArray([$header], NULL, 'A3');
            $count = 4;
            $idx = 1;
            
            $list = $assetBangunanPribadiRepository->findFilterAll($search_desa);
            foreach($list as $list)
            {
                $sheet->setCellValue("A".$count,$idx);
                $sheet->setCellValue("B".$count,$list->getNoShm());
                $sheet->setCellValue("C".$count,$list->getLuasan());
                $sheet->setCellValue("D".$count,$list->getNamaPemilik());
                $sheet->setCellValue("E".$count,$list->getStatus() ." , ".$list->getKeterangan());
                $sheet->getStyle('C'.$count)
                        ->getNumberFormat()
                        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
                $count++;
                $idx++;
            }

            $writer = new Xlsx($spreadsheet);
            $file = $this->getParameter('app.attachment_dir').'/data.xlsx';
            $writer->save($file);

            $response = new BinaryFileResponse($file);

            return $response;
        } 
        
    }

    /**
     * @Route("/UpdateStatusPembayaran", name="asset_bangunan_pribadi_update_status_pembayaran", methods={"POST"})
     */
    public function updateStatusPembayaran(Request $request, SluggerInterface $slugger): Response
    {
        $isNew = false;
        $StatusPembayaranId = $request->request->get('StatusPembayaranId');
        $Description = $request->request->get('description');
        $AssetBangunanPribadiId = $request->request->get('AssetBangunanPribadiId');
        $submittedToken = $request->request->get('_token');
        $Status = $request->request->get('status');
        $Tahun = $request->request->get('tahun');

        if ($request->isMethod('POST') && $this->isCsrfTokenValid('StatusPembayaranAssetBangunanPribadi', $submittedToken)) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $AssetBangunanPribadi =  $this->getDoctrine()
                ->getRepository(AssetBangunanPribadi::class)
                ->find($AssetBangunanPribadiId);

            $StatusPembayaranBangunanPribadi = $this->getDoctrine()
                ->getRepository(StatusPembayaranBangunanPribadi::class)
                ->find($StatusPembayaranId);

            if(!$StatusPembayaranBangunanPribadi)
            {
                $isNew = true;
                $StatusPembayaranBangunanPribadi = new StatusPembayaranBangunanPribadi();
            }
            
            $StatusPembayaranBangunanPribadi  ->setStatus($Status)
                                              ->setTahunPembayaran($Tahun)
                                              ->setAssetBangunanPribadi($AssetBangunanPribadi);
                                                                        
            if($isNew)
            {
                $entityManager->persist($StatusPembayaranBangunanPribadi);
            }
            
            $entityManager->flush();
            
            $this->addFlash(
                'success',
                'Data updated!'
            );
        }
       
        return $this->redirectToRoute('asset_bangunan_pribadi_edit',['id'=>$AssetBangunanPribadiId]);
    }
}
