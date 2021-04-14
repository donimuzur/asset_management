<?php

namespace App\Controller;

use App\Entity\BerkasPerusahaan;
use App\Form\BerkasPerusahaanType;
use App\Repository\BerkasPerusahaanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/Berkas/Perusahaan")
 */
class BerkasPerusahaanController extends AbstractController
{
    /**
     * @Route("/", name="berkas_perusahaan_index", methods={"GET"})
     */
    public function index(BerkasPerusahaanRepository $berkasPerusahaanRepository): Response
    {
        return $this->render('berkas_perusahaan/index.html.twig', [
            'berkas_perusahaans' => $berkasPerusahaanRepository->findAll(),
        ]);
    }

    /**
     * @Route("/New", name="berkas_perusahaan_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $berkasPerusahaan = new BerkasPerusahaan();
        $form = $this->createForm(BerkasPerusahaanType::class, $berkasPerusahaan);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $uFile = $form['attach_filename']->getData();
            if($uFile)
            {
                
                foreach( $uFile as $uFile )
                {
                    $berkasPerusahaanToSave = new BerkasPerusahaan();
                    $berkasPerusahaanToSave->setDeskripsi($berkasPerusahaan->getDeskripsi());
                    $berkasPerusahaanToSave->setPerusahaan($berkasPerusahaan->getPerusahaan());
                    $originalFilename = pathinfo($uFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilename = $uFile->getClientOriginalName().'-'.uniqid().'.'.$uFile->guessExtension();
                    $filType = $uFile->gettype();

                    $berkasPerusahaanToSave   ->setAttachSize($uFile->getSize())
                                        ->setAttachedTime(new \DateTime('now'))
                                        ->setAttachFilename($originalFilename)
                                        ->setAttachedBy($this->getUser())
                                        ->setAttachType($filType);
                                        
                    $entityManager->persist($berkasPerusahaanToSave);
                    $entityManager->flush();
                    $uFile->move(
                        $this->getParameter('app.attachment_dir').'/AttachmentPerusahaan',
                        $originalFilename
                    );
                }
                $this->addFlash(
                    'success',
                    'Attachment were uploaded!'
                );
                return $this->redirectToRoute('berkas_perusahaan_index');
            }
        }
        
        $error = $form->getErrors();
        if(!is_null($error) && $error != '')
        {
            $this->addFlash(
                'danger',
                $error
            );
        }

        return $this->render('berkas_perusahaan/new.html.twig', [
            'berkas_perusahaan' => $berkasPerusahaan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Edit/{id}", name="berkas_perusahaan_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BerkasPerusahaan $berkasPerusahaan): Response
    {
        $form = $this->createForm(BerkasPerusahaanType::class, $berkasPerusahaan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Attachment were uploaded!'
            );
            return $this->redirectToRoute('berkas_perusahaan_index');
        }

        $error = $form->getErrors();
        if(!is_null($error) && $error != '')
        {
            $this->addFlash(
                'error',
                $error
            );
        }

        return $this->render('berkas_perusahaan/edit.html.twig', [
            'berkas_perusahaan' => $berkasPerusahaan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Delete", name="berkas_perusahaan_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $masterBerkasPerusahaanToDelete = $request->request->get('chkBerkasPerusahaan');

        if ($this->isCsrfTokenValid('delete', $request->request->get('_token'))) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            
            foreach($masterBerkasPerusahaanToDelete as $masterBerkasPerusahaanToDelete)
            {
                    $ObjectToDelete  =  $this->getDoctrine()
                    ->getRepository(BerkasPerusahaan::class)
                    ->find($masterBerkasPerusahaanToDelete); 

                    $entityManager->remove($ObjectToDelete);
                    
                    if($ObjectToDelete->getAttachFileName())
                    {
                        $filename = $this->getParameter('app.attachment_dir').'/AttachmentPerusahaan/'.$ObjectToDelete->getAttachFileName();
                        $filesystem = new Filesystem();
                        $filesystem->remove($filename);
                    }
                    
            }

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Success, Data were deleted'        
            );
            
        }
        
        return $this->redirectToRoute('berkas_perusahaan_index');
    }

    /**
     * @Route("/DownloadAttachment/{id}", name="berkas_perusahaan_download_attachment",methods={"GET","POST"})
     */
    public function downloadAttachment(Request $request, int $id): Response
    {
        $AttachmentFile  =  $this->getDoctrine()
            ->getRepository(BerkasPerusahaan::class)
            ->find($id); 
        
        if (!empty($AttachmentFile)) {

            $file = $this->getParameter('app.attachment_dir').'/AttachmentPerusahaan/'.$AttachmentFile->getAttachFilename();
            
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
            return $this->redirectToRoute('berkas_perusahaan_edit',['id'=>$id]);
        }
    }

}
