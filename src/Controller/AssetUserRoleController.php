<?php

namespace App\Controller;

use App\Entity\AssetUserRole;
use App\Form\AssetUserRoleType;
use App\Repository\AssetUserRoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Master/AssetUserRole")
 */
class AssetUserRoleController extends AbstractController
{
    /**
     * @Route("/", name="master_asset_user_role_index", methods={"GET"})
     */
    public function index(AssetUserRoleRepository $assetUserRoleRepository): Response
    {
        return $this->render('asset_user_role/index.html.twig', [
            'asset_user_roles' => $assetUserRoleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="master_asset_user_role_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $assetUserRole = new AssetUserRole();
        $form = $this->createForm(AssetUserRoleType::class, $assetUserRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($assetUserRole);
            $entityManager->flush();

            return $this->redirectToRoute('AssetUserRole');
        }

        return $this->render('asset_user_role/new.html.twig', [
            'asset_user_role' => $assetUserRole,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/View/{Id}", name="master_asset_user_role_show", methods={"GET"})
     */
    public function show(AssetUserRole $assetUserRole): Response
    {
        return $this->render('asset_user_role/show.html.twig', [
            'asset_user_role' => $assetUserRole,
        ]);
    }

    /**
     * @Route("/Edit/{Id}", name="master_asset_user_role_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AssetUserRole $assetUserRole): Response
    {
        $form = $this->createForm(AssetUserRoleType::class, $assetUserRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('master_asset_user_role_index');
        }

        return $this->render('asset_user_role/edit.html.twig', [
            'asset_user_role' => $assetUserRole,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Delete/{Id}", name="master_asset_user_role_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AssetUserRole $assetUserRole): Response
    {
        if ($this->isCsrfTokenValid('delete'.$assetUserRole->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($assetUserRole);
            $entityManager->flush();
        }

        return $this->redirectToRoute('master_asset_user_role_index');
    }
}
