<?php

namespace App\Controller;

use App\Entity\AssetTanahPerusahaan;
use App\Entity\AttachmentAssetTanahPerusahaan;
use App\Form\AssetTanahPerusahaanType;
use App\Repository\AssetTanahPerusahaanRepository;
use App\Repository\MasterWilayahRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/Asset/Tanah/Perusahaan")
 */
class AssetTanahPerusahaanController extends AbstractController
{
    /**
     * @Route("/", name="asset_tanah_perusahaan_index", methods={"GET"})
     */
    public function index(AssetTanahPerusahaanRepository $assetTanahPerusahaanRepository): Response
    {
        return $this->render('asset_tanah_perusahaan/index.html.twig', [
            'asset_tanah_perusahaans' => $assetTanahPerusahaanRepository->findAll(),
        ]);
    }

    /**
     * @Route("/New", name="asset_tanah_perusahaan_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $assetTanahPerusahaan = new AssetTanahPerusahaan();
        $form = $this->createForm(AssetTanahPerusahaanType::class, $assetTanahPerusahaan);
        $form->handleRequest($request);
        $getId = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($assetTanahPerusahaan);
            $entityManager->flush();
            $getId = $assetTanahPerusahaan->getId();

            $this->addFlash(
                'success',
                'Success, data were saved!'
            );

            return $this->redirectToRoute('asset_tanah_perusahaan_edit',['id'=>$getId]);
        }

        return $this->render('asset_tanah_perusahaan/new.html.twig', [
            'asset_tanah_perusahaan' => $assetTanahPerusahaan,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/UpdateAttachment", name="asset_tanah_perusahaan_update_attachment", methods={"POST"})
     */
    public function update(Request $request, SluggerInterface $slugger): Response
    {
        $isNew = false;
        $AttachmentId = $request->request->get('AttachmentId');
        $Description = $request->request->get('description');
        $AssetTanahPerusahaanId = $request->request->get('AssetTanahPerusahaanId');
        $submittedToken = $request->request->get('_token');
        $uFile = $request->files->get('ufile');

        if ($request->isMethod('POST') && $this->isCsrfTokenValid('AttachmentAssetTanahPerusahaan', $submittedToken)) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $AssetTanahPerusahaan =  $this->getDoctrine()
                ->getRepository(AssetTanahPerusahaan::class)
                ->find($AssetTanahPerusahaanId);

            $AttachmentAssetTanahPerusahaan = $this->getDoctrine()
                ->getRepository(AttachmentAssetTanahPerusahaan::class)
                ->find($AttachmentId);

            if(!$AttachmentAssetTanahPerusahaan)
            {
                $isNew = true;
                $AttachmentAssetTanahPerusahaan = new AttachmentAssetTanahPerusahaan();
            }

            if ($uFile) {
                $originalFilename = pathinfo($uFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = uniqid().'.'.$uFile->guessExtension();
                $content = file_get_contents($uFile);
                $filType = $uFile->gettype();

                $AttachmentAssetTanahPerusahaan->setAttachAttachment($content)
                                              ->setAttachSize($uFile->getSize())
                                              ->setAttachedTime(new \DateTime('now'))
                                              ->setAttachFilename($newFilename)
                                              ->setAttachedBy($this->getUser())
                                              ->setAttachType($filType);
            }

            $AttachmentAssetTanahPerusahaan->setAssetTanahPerusahaan($AssetTanahPerusahaan)
                                            ->setAttachDesc($Description);
            if($isNew)
            {
                $entityManager->persist($AttachmentAssetTanahPerusahaan);
            }
            
            $entityManager->flush();
            
            $this->addFlash(
                'success',
                'Attachment were uploaded!'
            );
        }
       
        return $this->redirectToRoute('asset_tanah_perusahaan_edit',['id'=>$AssetTanahPerusahaanId]);
    }
    
      /**
     * @Route("/DeleteAttachment", name="asset_tanah_perusahaan_attacment_delete", methods={"DELETE"})
     */
    public function deleteAttachment(Request $request): Response
    {
        $attachmentsToDelete = $request->request->get('chkAssetTanah');
        $AssetTanahPerusahaanId = $request->request->get('AssetTanahPerusahaanId');

        if ($this->isCsrfTokenValid('delete', $request->request->get('_token'))) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            
            foreach($attachmentsToDelete as $attachmentsToDelete)
            {
                    $AttachmentObjectToDelete  =  $this->getDoctrine()
                    ->getRepository(AttachmentAssetTanahPerusahaan::class)
                    ->find($attachmentsToDelete); 

                    $entityManager->remove($AttachmentObjectToDelete);
            }

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Attachment deleted'            
            );
            
        }

        return $this->redirectToRoute('asset_tanah_perusahaan_edit',['id'=>$AssetTanahPerusahaanId]);
    }


    /**
     * @Route("/View/{id}", name="asset_tanah_perusahaan_show", methods={"GET"})
     */
    public function show(AssetTanahPerusahaan $assetTanahPerusahaan): Response
    {
        return $this->render('asset_tanah_perusahaan/show.html.twig', [
            'asset_tanah_perusahaan' => $assetTanahPerusahaan,
        ]);
    }

  
    /**
     * @Route("/Edit/{id}", name="asset_tanah_perusahaan_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AssetTanahPerusahaan $assetTanahPerusahaan): Response
    {
        $form = $this->createForm(AssetTanahPerusahaanType::class, $assetTanahPerusahaan);
        $form->handleRequest($request);
       
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('asset_tanah_perusahaan_edit',['id'=>$assetTanahPerusahaan->getId()]);
        }
        
        return $this->render('asset_tanah_perusahaan/edit.html.twig', [
            'asset_tanah_perusahaan' => $assetTanahPerusahaan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Delete", name="asset_tanah_perusahaan_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $assetTanahPerusahaanToDelete = $request->request->get('chkAssetTanah');

        if ($this->isCsrfTokenValid('delete', $request->request->get('_token'))) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            
            foreach($assetTanahPerusahaanToDelete as $assetTanahPerusahaanToDelete)
            {
                    $AttachmentObjectToDelete  =  $this->getDoctrine()
                    ->getRepository(AssetTanahPerusahaan::class)
                    ->find($assetTanahPerusahaanToDelete); 

                    $entityManager->remove($AttachmentObjectToDelete);
            }

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Success, Data were deleted'        
            );
            
        }

        return $this->redirectToRoute('asset_tanah_perusahaan_index');
    }

      /**
     * @Route("/DownloadAttachment/{AssetTanahPerusahaanId}/{id}", name="asset_tanah_perusahaan_download_attachment",methods={"GET","POST"})
     */
    public function downloadAttachment(Request $request, int $id, int $AssetTanahPerusahaanId): Response
    {
        // $AssetTanahPerusahaanId = $request->request->get('AssetTanahPerusahaanId');
        // $attachmentId = $request->request->get('id');
        $AttachmentFile  =  $this->getDoctrine()
            ->getRepository(AttachmentAssetTanahPerusahaan::class)
            ->find($id); 
        
        if (!empty($AttachmentFile)) {

            $fileContent = $AttachmentFile->getAttachAttachment(); 
            
            $fileType = $AttachmentFile->getAttachType(); 
            $fileSize = $AttachmentFile->getAttachSize(); 
            $fileName = $AttachmentFile->getAttachFilename(); 
            
            $response = new Response(stream_get_contents($fileContent));
            $response->headers->set('Expires', '0');
            $response->headers->set("Cache-Control", "must-revalidate, post-check=0, pre-check=0, max-age=0");
            $response->headers->set("Cache-Control", "private", false);
            $response->headers->set("Content-Type", $fileType);
            $response->headers->set("Content-Disposition", 'attachment; filename="' . $fileName . '";');
            $response->headers->set("Content-Transfer-Encoding", "binary");
            $response->headers->set("Content-Length", $fileSize);

            return $response;
        } else {
            return $this->redirectToRoute('asset_tanah_perusahaan_edit',['id'=>$AssetTanahPerusahaanId]);
        }
    }

     /**
     * @Route("/GetDataProvinsiList/", name="asset_tanah_perusahaan_getDataProvinsiList", methods={"GET","POST"})
     */
    public function GetDataProvinsiList(Request $request, SerializerInterface $serializer, MasterWilayahRepository $masterWilayahRepository): JsonResponse
    {
        $models = $masterWilayahRepository->getProvinsiList();
        $data = $serializer->serialize($models,  'json');
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
    
    /**
     * @Route("/GetDataMadyaList/{provinsiId}", name="asset_tanah_perusahaan_getDataMadyaList", methods={"GET","POST"})
     */
    public function GetDataMadyaList(Request $request,string $provinsiId, SerializerInterface $serializer, MasterWilayahRepository $masterWilayahRepository): JsonResponse
    {
        $models = $masterWilayahRepository->getMadyaList($provinsiId);
        $data = $serializer->serialize($models,  'json');
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/GetDataKecamatanList/{madyaId}", name="asset_tanah_perusahaan_getDataKecamatanList", methods={"GET","POST"})
     */
    public function GetDataKecamatanList(Request $request, string $madyaId, SerializerInterface $serializer, MasterWilayahRepository $masterWilayahRepository): JsonResponse
    {
        $models = $masterWilayahRepository->getKecamatanList($madyaId);
        $data = $serializer->serialize($models,  'json');
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

     /**
     * @Route("/GetDataDesaList/{kecId}", name="asset_tanah_perusahaan_getDataDesaList", methods={"GET","POST"})
     */
    public function GetDataDesaList(Request $request, string $kecId, SerializerInterface $serializer, MasterWilayahRepository $masterWilayahRepository): JsonResponse
    {
        $models = $masterWilayahRepository->getDesaList($kecId);
        $data = $serializer->serialize($models,  'json');
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
