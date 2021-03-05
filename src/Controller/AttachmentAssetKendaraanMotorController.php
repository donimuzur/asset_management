<?php

namespace App\Controller;

use App\Entity\AttachmentAssetKendaraanMotor;
use App\Form\AttachmentAssetKendaraanMotorType;
use App\Repository\AttachmentAssetKendaraanMotorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/attachment/asset/kendaraan/motor")
 */
class AttachmentAssetKendaraanMotorController extends AbstractController
{
    /**
     * @Route("/", name="attachment_asset_kendaraan_motor_index", methods={"GET"})
     */
    public function index(AttachmentAssetKendaraanMotorRepository $attachmentAssetKendaraanMotorRepository): Response
    {
        return $this->render('attachment_asset_kendaraan_motor/index.html.twig', [
            'attachment_asset_kendaraan_motors' => $attachmentAssetKendaraanMotorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="attachment_asset_kendaraan_motor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $attachmentAssetKendaraanMotor = new AttachmentAssetKendaraanMotor();
        $form = $this->createForm(AttachmentAssetKendaraanMotorType::class, $attachmentAssetKendaraanMotor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($attachmentAssetKendaraanMotor);
            $entityManager->flush();

            return $this->redirectToRoute('attachment_asset_kendaraan_motor_index');
        }

        return $this->render('attachment_asset_kendaraan_motor/new.html.twig', [
            'attachment_asset_kendaraan_motor' => $attachmentAssetKendaraanMotor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="attachment_asset_kendaraan_motor_show", methods={"GET"})
     */
    public function show(AttachmentAssetKendaraanMotor $attachmentAssetKendaraanMotor): Response
    {
        return $this->render('attachment_asset_kendaraan_motor/show.html.twig', [
            'attachment_asset_kendaraan_motor' => $attachmentAssetKendaraanMotor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="attachment_asset_kendaraan_motor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AttachmentAssetKendaraanMotor $attachmentAssetKendaraanMotor): Response
    {
        $form = $this->createForm(AttachmentAssetKendaraanMotorType::class, $attachmentAssetKendaraanMotor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('attachment_asset_kendaraan_motor_index');
        }

        return $this->render('attachment_asset_kendaraan_motor/edit.html.twig', [
            'attachment_asset_kendaraan_motor' => $attachmentAssetKendaraanMotor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="attachment_asset_kendaraan_motor_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AttachmentAssetKendaraanMotor $attachmentAssetKendaraanMotor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attachmentAssetKendaraanMotor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($attachmentAssetKendaraanMotor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('attachment_asset_kendaraan_motor_index');
    }
}
