<?php

namespace App\Controller;

use App\Entity\AssetKendaraanMobil;
use App\Entity\AttachmentAssetKendaraanMobil;
use App\Form\AssetKendaraanMobilType;
use App\Repository\AssetKendaraanMobilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/Asset/Kendaraan/Mobil")
 */
class AssetKendaraanMobilController extends AbstractController
{
    /**
     * @Route("/", name="asset_kendaraan_mobil_index", methods={"GET"})
     */
    public function index(AssetKendaraanMobilRepository $assetKendaraanMobilRepository): Response
    {
        return $this->render('asset_kendaraan_mobil/index.html.twig', [
            'asset_kendaraan_mobils' => $assetKendaraanMobilRepository->findAllSorted(),
        ]);
    }

    /**
     * @Route("/New", name="asset_kendaraan_mobil_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $assetKendaraanMobil = new AssetKendaraanMobil();
        $form = $this->createForm(AssetKendaraanMobilType::class, $assetKendaraanMobil);
        $form->handleRequest($request);
        $getId = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($assetKendaraanMobil);
            $entityManager->flush();
            $getId = $assetKendaraanMobil->getId();

            $this->addFlash(
                'success',
                'Success, data were saved!'
            );

            return $this->redirectToRoute('asset_kendaraan_mobil_edit',['id'=>$getId]);
        }

        return $this->render('asset_kendaraan_mobil/new.html.twig', [
            'asset_kendaraan_mobil' => $assetKendaraanMobil,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/UpdateAttachment", name="asset_kendaraan_mobil_update_attachment", methods={"POST"})
     */
    public function update(Request $request, SluggerInterface $slugger): Response
    {
        $isNew = false;
        $AttachmentId = $request->request->get('AttachmentId');
        $Description = $request->request->get('description');
        $AssetKendaraanMobilId = $request->request->get('AssetKendaraanMobilId');
        $submittedToken = $request->request->get('_token');
        $uFile = $request->files->get('ufile');

        if ($request->isMethod('POST') && $this->isCsrfTokenValid('AttachmentAssetKendaraanMobil', $submittedToken)) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $AssetKendaraanMobil =  $this->getDoctrine()
                ->getRepository(AssetKendaraanMobil::class)
                ->find($AssetKendaraanMobilId);

            $AttachmentAssetKendaraanMobil = $this->getDoctrine()
                ->getRepository(AttachmentAssetKendaraanMobil::class)
                ->find($AttachmentId);

            if(!$AttachmentAssetKendaraanMobil)
            {
                $isNew = true;
                $AttachmentAssetKendaraanMobil = new AttachmentAssetKendaraanMobil();
            }

            if ($uFile) {
                $originalFilename = pathinfo($uFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = uniqid().'.'.$uFile->guessExtension();
                $content = file_get_contents($uFile);
                $filType = $uFile->gettype();

                $AttachmentAssetKendaraanMobil->setAttachSize($uFile->getSize())
                                              ->setAttachedTime(new \DateTime('now'))
                                              ->setAttachFilename($newFilename)
                                              ->setAttachedBy($this->getUser())
                                              ->setAttachType($filType);
            }

            $AttachmentAssetKendaraanMobil->setAssetKendaraanMobil($AssetKendaraanMobil)
                                            ->setAttachDesc($Description);
            if($isNew)
            {
                $entityManager->persist($AttachmentAssetKendaraanMobil);
            }
            
            $entityManager->flush();
            $uFile->move(
                $this->getParameter('app.attachment_dir').'/AssetKendaraanMobil',
                $newFilename
            );
            $this->addFlash(
                'success',
                'Attachment were uploaded!'
            );
        }
       
        return $this->redirectToRoute('asset_kendaraan_mobil_edit',['id'=>$AssetKendaraanMobilId]);
    }
    
      /**
     * @Route("/DeleteAttachment", name="asset_kendaraan_mobil_attacment_delete", methods={"DELETE"})
     */
    public function deleteAttachment(Request $request): Response
    {
        $attachmentsToDelete = $request->request->get('chkAssetKendaraan');
        $AssetKendaraanMobilId = $request->request->get('AssetKendaraanMobilId');

        if ($this->isCsrfTokenValid('delete', $request->request->get('_token')) && !is_null($attachmentsToDelete)) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            
            foreach($attachmentsToDelete as $attachmentsToDelete)
            {
                    $AttachmentObjectToDelete  =  $this->getDoctrine()
                    ->getRepository(AttachmentAssetKendaraanMobil::class)
                    ->find($attachmentsToDelete); 

                    $entityManager->remove($AttachmentObjectToDelete);
            }

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Attachment deleted'            
            );
            
        }

        return $this->redirectToRoute('asset_kendaraan_mobil_edit',['id'=>$AssetKendaraanMobilId]);
    }


    /**
     * @Route("/View/{id}", name="asset_kendaraan_mobil_show", methods={"GET"})
     */
    public function show(AssetKendaraanMobil $assetKendaraanMobil): Response
    {
        return $this->render('asset_kendaraan_mobil/show.html.twig', [
            'asset_kendaraan_mobil' => $assetKendaraanMobil,
        ]);
    }

  
    /**
     * @Route("/Edit/{id}", name="asset_kendaraan_mobil_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AssetKendaraanMobil $assetKendaraanMobil): Response
    {
        $form = $this->createForm(AssetKendaraanMobilType::class, $assetKendaraanMobil);
        $form->handleRequest($request);
       
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('asset_kendaraan_mobil_edit',['id'=>$assetKendaraanMobil->getId()]);
        }
        
        return $this->render('asset_kendaraan_mobil/edit.html.twig', [
            'asset_kendaraan_mobil' => $assetKendaraanMobil,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Delete", name="asset_kendaraan_mobil_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $assetKendaraanMobilToDelete = $request->request->get('chkAssetKendaraanMobil');

        if ($this->isCsrfTokenValid('delete', $request->request->get('_token')) && !is_null($assetKendaraanMobilToDelete)) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            
            foreach($assetKendaraanMobilToDelete as $assetKendaraanMobilToDelete)
            {
                    $AttachmentObjectToDelete  =  $this->getDoctrine()
                    ->getRepository(AssetKendaraanMobil::class)
                    ->find($assetKendaraanMobilToDelete); 

                    $entityManager->remove($AttachmentObjectToDelete);
            }

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Success, Data were deleted'        
            );
            
        }

        return $this->redirectToRoute('asset_kendaraan_mobil_index');
    }

      /**
     * @Route("/DownloadAttachment/{AssetKendaraanMobilId}/{id}", name="asset_kendaraan_mobil_download_attachment",methods={"GET","POST"})
     */
    public function downloadAttachment(Request $request, int $id, int $AssetKendaraanMobilId): Response
    {
        // $AssetKendaraanMobilId = $request->request->get('AssetKendaraanMobilId');
        // $attachmentId = $request->request->get('id');
        $AttachmentFile  =  $this->getDoctrine()
            ->getRepository(AttachmentAssetKendaraanMobil::class)
            ->find($id); 
        
        if (!empty($AttachmentFile)) {
            $file = $this->getParameter('app.attachment_dir').'\/AssetKendaraanMobil\/'.$AttachmentFile->getAttachFilename();

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
            return $this->redirectToRoute('asset_kendaraan_mobil_edit',['id'=>$AssetKendaraanMobilId]);
        }
    }
}
