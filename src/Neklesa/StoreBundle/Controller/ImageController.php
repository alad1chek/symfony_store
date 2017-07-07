<?php

namespace Neklesa\StoreBundle\Controller;

use Neklesa\StoreBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Image controller.
 *
 */
class ImageController extends Controller
{
    /**
     * Lists all image entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $images = $em->getRepository('NeklesaStoreBundle:Image')->findAll();

        return $this->render('NeklesaStoreBundle:image:index.html.twig', array(
            'images' => $images,
        ));
    }

    /**
     * Creates a new image entity.
     *
     */
    public function newAction(Request $request)
    {
        $image = new Image();
        $form = $this->createForm('Neklesa\StoreBundle\Form\ImageType', $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form['url']->getData();
            $file->move('assets/image/pruduct_image',$file->getClientOriginalName());
            //$file['url']=$file->getClientOriginalName();
            $image->setUrl($file->getClientOriginalName());

            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            return $this->redirectToRoute('crud-product_show', array('id' => $image->getProduct()));
        }

        return $this->render('NeklesaStoreBundle:image:new.html.twig', array(
            'image' => $image,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a image entity.
     *
     */
    public function showAction(Image $image)
    {
        $deleteForm = $this->createDeleteForm($image);

        return $this->render('NeklesaStoreBundle:image:show.html.twig', array(
            'image' => $image,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing image entity.
     *
     */
    public function editAction(Request $request, Image $image)
    {
        $deleteForm = $this->createDeleteForm($image);
        $editForm = $this->createForm('Neklesa\StoreBundle\Form\ImageType', $image);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('crud-image_edit', array('id' => $image->getId()));
        }

        return $this->render('NeklesaStoreBundle:image:edit.html.twig', array(
            'image' => $image,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a image entity.
     *
     */
    public function deleteAction(Request $request, Image $image)
    {
        $form = $this->createDeleteForm($image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();
        }

        return $this->redirectToRoute('crud-image_index');
    }

    /**
     * Creates a form to delete a image entity.
     *
     * @param Image $image The image entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Image $image)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crud-image_delete', array('id' => $image->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
