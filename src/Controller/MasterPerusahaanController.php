<?php

namespace App\Controller;

use App\Entity\MasterPerusahaan;
use App\Form\MasterPerusahaanType;
use App\Repository\MasterPerusahaanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Master/Perusahaan")
 */
class MasterPerusahaanController extends AbstractController
{
    /**
     * @Route("/", name="master_perusahaan_index", methods={"GET"})
     */
    public function index(MasterPerusahaanRepository $masterPerusahaanRepository): Response
    {
        return $this->render('master_perusahaan/index.html.twig', [
            'master_perusahaans' => $masterPerusahaanRepository->findAll(),
        ]);
    }

    /**
     * @Route("/New", name="master_perusahaan_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $masterPerusahaan = new MasterPerusahaan();
        $form = $this->createForm(MasterPerusahaanType::class, $masterPerusahaan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($masterPerusahaan);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Success, Data were saved'        
            );

            return $this->redirectToRoute('master_perusahaan_index');
        }

        return $this->render('master_perusahaan/new.html.twig', [
            'master_perusahaan' => $masterPerusahaan,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/Edit/{id}", name="master_perusahaan_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MasterPerusahaan $masterPerusahaan): Response
    {
        $form = $this->createForm(MasterPerusahaanType::class, $masterPerusahaan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Success, Data were saved'        
            );

            return $this->redirectToRoute('master_perusahaan_index');
        }

        return $this->render('master_perusahaan/edit.html.twig', [
            'master_perusahaan' => $masterPerusahaan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Delete", name="master_perusahaan_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $masterMasterPerusahaanToDelete = $request->request->get('chkMasterPerusahaan');

        if ($this->isCsrfTokenValid('delete', $request->request->get('_token'))) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            
            foreach($masterMasterPerusahaanToDelete as $masterMasterPerusahaanToDelete)
            {
                    $ObjectToDelete  =  $this->getDoctrine()
                    ->getRepository(MasterPerusahaan::class)
                    ->find($masterMasterPerusahaanToDelete); 

                    $entityManager->remove($ObjectToDelete);
            }

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Success, Data were deleted'        
            );
            
        }
        
        return $this->redirectToRoute('master_perusahaan_index');
    }
}
