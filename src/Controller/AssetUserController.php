<?php

namespace App\Controller;

use App\Helper\Utility\PasswordHash;
use App\Entity\AssetUser;
use App\Form\AssetUserType;
use App\Repository\AssetUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Master/AssetUser")
 */
class AssetUserController extends AbstractController
{
    /**
     * @Route("/", name="master_asset_user_index", methods={"GET"})
     */
    public function index(AssetUserRepository $assetUserRepository): Response
    {
        return $this->render('asset_user/index.html.twig', [
            'asset_users' => $assetUserRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="master_asset_user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $assetUser = new AssetUser();
        $form = $this->createForm(AssetUserType::class, $assetUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {    
            $PasswordHash = new PasswordHash();
            $assetUser->setUserPassword($PasswordHash->hash($assetUser->getUserPassword()));
            $assetUser->setCreatedBy('Administrator');
            $date=  new \DateTime('now');
            $assetUser->setCreatedDate($date);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($assetUser);
            $entityManager->flush();

            return $this->redirectToRoute('master_asset_user_index');
        }

        return $this->render('asset_user/new.html.twig', [
            'asset_user' => $assetUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/View/{Id}", name="master_asset_user_show", methods={"GET"})
     */
    public function show(AssetUser $assetUser): Response
    {
        return $this->render('asset_user/show.html.twig', [
            'asset_user' => $assetUser,
        ]);
    }

    /**
     * @Route("/Edit/{Id}", name="master_asset_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AssetUser $assetUser): Response
    {
        $form = $this->createForm(AssetUserType::class, $assetUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('master_asset_user_index');
        }

        return $this->render('asset_user/edit.html.twig', [
            'asset_user' => $assetUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Delete/{Id}", name="master_asset_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AssetUser $assetUser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$assetUser->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($assetUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('master_asset_user_index');
    }
}
