<?php

namespace App\Controller;

use App\Entity\AssetKendaraanMotor;
use App\Entity\AttachmentAssetKendaraanMotor;
use App\Form\AssetKendaraanMotorType;
use App\Repository\AssetKendaraanMotorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/Asset/Kendaraan/Motor")
 */
class AssetKendaraanMotorController extends AbstractController
{
    /**
     * @Route("/", name="asset_kendaraan_motor_index", methods={"GET"})
     */
    public function index(AssetKendaraanMotorRepository $assetKendaraanMotorRepository): Response
    {
        return $this->render('asset_kendaraan_motor/index.html.twig', [
            'asset_kendaraan_motors' => $assetKendaraanMotorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/New", name="asset_kendaraan_motor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $assetKendaraanMotor = new AssetKendaraanMotor();
        $form = $this->createForm(AssetKendaraanMotorType::class, $assetKendaraanMotor);
        $form->handleRequest($request);
        $getId = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($assetKendaraanMotor);
            $entityManager->flush();
            $getId = $assetKendaraanMotor->getId();

            $this->addFlash(
                'success',
                'Success, data were saved!'
            );

            return $this->redirectToRoute('asset_kendaraan_motor_edit',['id'=>$getId]);
        }

        return $this->render('asset_kendaraan_motor/new.html.twig', [
            'asset_kendaraan_motor' => $assetKendaraanMotor,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/UpdateAttachment", name="asset_kendaraan_motor_update_attachment", methods={"POST"})
     */
    public function update(Request $request, SluggerInterface $slugger): Response
    {
        $isNew = false;
        $AttachmentId = $request->request->get('AttachmentId');
        $Description = $request->request->get('description');
        $AssetKendaraanMotorId = $request->request->get('AssetKendaraanMotorId');
        $submittedToken = $request->request->get('_token');
        $uFile = $request->files->get('ufile');

        if ($request->isMethod('POST') && $this->isCsrfTokenValid('AttachmentAssetKendaraanMotor', $submittedToken)) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $AssetKendaraanMotor =  $this->getDoctrine()
                ->getRepository(AssetKendaraanMotor::class)
                ->find($AssetKendaraanMotorId);

            $AttachmentAssetKendaraanMotor = $this->getDoctrine()
                ->getRepository(AttachmentAssetKendaraanMotor::class)
                ->find($AttachmentId);

            if(!$AttachmentAssetKendaraanMotor)
            {
                $isNew = true;
                $AttachmentAssetKendaraanMotor = new AttachmentAssetKendaraanMotor();
            }

            if ($uFile) {
                $originalFilename = pathinfo($uFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = uniqid().'.'.$uFile->guessExtension();
                $content = file_get_contents($uFile);
                $filType = $uFile->gettype();

                $AttachmentAssetKendaraanMotor->setAttachAttachment($content)
                                              ->setAttachSize($uFile->getSize())
                                              ->setAttachedTime(new \DateTime('now'))
                                              ->setAttachFilename($newFilename)
                                              ->setAttachedBy($this->getUser())
                                              ->setAttachType($filType);
            }

            $AttachmentAssetKendaraanMotor->setAssetKendaraanMotor($AssetKendaraanMotor)
                                            ->setAttachDesc($Description);
            if($isNew)
            {
                $entityManager->persist($AttachmentAssetKendaraanMotor);
            }
            
            $entityManager->flush();
            
            $this->addFlash(
                'success',
                'Attachment were uploaded!'
            );
        }
       
        return $this->redirectToRoute('asset_kendaraan_motor_edit',['id'=>$AssetKendaraanMotorId]);
    }
    
      /**
     * @Route("/DeleteAttachment", name="asset_kendaraan_motor_attacment_delete", methods={"DELETE"})
     */
    public function deleteAttachment(Request $request): Response
    {
        $attachmentsToDelete = $request->request->get('chkAssetKendaraan');
        $AssetKendaraanMotorId = $request->request->get('AssetKendaraanMotorId');

        if ($this->isCsrfTokenValid('delete', $request->request->get('_token')) && !is_null($attachmentsToDelete)) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            
            foreach($attachmentsToDelete as $attachmentsToDelete)
            {
                    $AttachmentObjectToDelete  =  $this->getDoctrine()
                    ->getRepository(AttachmentAssetKendaraanMotor::class)
                    ->find($attachmentsToDelete); 

                    $entityManager->remove($AttachmentObjectToDelete);
            }

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Attachment deleted'            
            );
            
        }

        return $this->redirectToRoute('asset_kendaraan_motor_edit',['id'=>$AssetKendaraanMotorId]);
    }


    /**
     * @Route("/View/{id}", name="asset_kendaraan_motor_show", methods={"GET"})
     */
    public function show(AssetKendaraanMotor $assetKendaraanMotor): Response
    {
        return $this->render('asset_kendaraan_motor/show.html.twig', [
            'asset_kendaraan_motor' => $assetKendaraanMotor,
        ]);
    }

  
    /**
     * @Route("/Edit/{id}", name="asset_kendaraan_motor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AssetKendaraanMotor $assetKendaraanMotor): Response
    {
        $form = $this->createForm(AssetKendaraanMotorType::class, $assetKendaraanMotor);
        $form->handleRequest($request);
       
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('asset_kendaraan_motor_edit',['id'=>$assetKendaraanMotor->getId()]);
        }
        
        return $this->render('asset_kendaraan_motor/edit.html.twig', [
            'asset_kendaraan_motor' => $assetKendaraanMotor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Delete", name="asset_kendaraan_motor_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $assetKendaraanMotorToDelete = $request->request->get('chkAssetKendaraanMotor');

        if ($this->isCsrfTokenValid('delete', $request->request->get('_token')) && !is_null($assetKendaraanMotorToDelete)) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            
            foreach($assetKendaraanMotorToDelete as $assetKendaraanMotorToDelete)
            {
                    $AttachmentObjectToDelete  =  $this->getDoctrine()
                    ->getRepository(AssetKendaraanMotor::class)
                    ->find($assetKendaraanMotorToDelete); 

                    $entityManager->remove($AttachmentObjectToDelete);
            }

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Success, Data were deleted'        
            );
            
        }

        return $this->redirectToRoute('asset_kendaraan_motor_index');
    }

      /**
     * @Route("/DownloadAttachment/{AssetKendaraanMotorId}/{id}", name="asset_kendaraan_motor_download_attachment",methods={"GET","POST"})
     */
    public function downloadAttachment(Request $request, int $id, int $AssetKendaraanMotorId): Response
    {
        // $AssetKendaraanMotorId = $request->request->get('AssetKendaraanMotorId');
        // $attachmentId = $request->request->get('id');
        $AttachmentFile  =  $this->getDoctrine()
            ->getRepository(AttachmentAssetKendaraanMotor::class)
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
            return $this->redirectToRoute('asset_kendaraan_motor_edit',['id'=>$AssetKendaraanMotorId]);
        }
    }
}
