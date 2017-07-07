<?php

namespace Neklesa\StoreBundle\Controller;

use Neklesa\StoreBundle\Entity\Categorylink;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categorylink controller.
 *
 */
class CategorylinkController extends Controller
{
    /**
     * Lists all categorylink entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorylinks = $em->getRepository('NeklesaStoreBundle:Categorylink')->findAll();

        return $this->render('NeklesaStoreBundle:categorylink:index.html.twig', array(
            'categorylinks' => $categorylinks,
        ));
    }

    /**
     * Creates a new categorylink entity.
     *
     */
    public function newAction(Request $request)
    {
        $categorylink = new Categorylink();
        $form = $this->createForm('Neklesa\StoreBundle\Form\CategorylinkType', $categorylink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorylink);
            $em->flush();

            return $this->redirectToRoute('crud-product_show', array('id' => $categorylink->getProduct()));
        }

        return $this->render('NeklesaStoreBundle:categorylink:new.html.twig', array(
            'categorylink' => $categorylink,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorylink entity.
     *
     */
    public function showAction(Categorylink $categorylink)
    {
        $deleteForm = $this->createDeleteForm($categorylink);

        return $this->render('NeklesaStoreBundle:categorylink:show.html.twig', array(
            'categorylink' => $categorylink,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorylink entity.
     *
     */
    public function editAction(Request $request, Categorylink $categorylink)
    {
        $deleteForm = $this->createDeleteForm($categorylink);
        $editForm = $this->createForm('Neklesa\StoreBundle\Form\CategorylinkType', $categorylink);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('crud-categorylink_edit', array('id' => $categorylink->getId()));
        }

        return $this->render('NeklesaStoreBundle:categorylink:edit.html.twig', array(
            'categorylink' => $categorylink,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorylink entity.
     *
     */
    public function deleteAction(Request $request, Categorylink $categorylink)
    {
        $form = $this->createDeleteForm($categorylink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorylink);
            $em->flush();
        }

        return $this->redirectToRoute('crud-categorylink_index');
    }

    /**
     * Creates a form to delete a categorylink entity.
     *
     * @param Categorylink $categorylink The categorylink entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categorylink $categorylink)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crud-categorylink_delete', array('id' => $categorylink->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
