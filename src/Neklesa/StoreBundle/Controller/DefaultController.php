<?php

namespace Neklesa\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->redirectToRoute('neklesa_store_list');
    }
    
    public function  listAction($id = 0){

        $rep = $this->getDoctrine()->getRepository('NeklesaStoreBundle:Category');
        $products = $this->getDoctrine()->getManager()
            ->createQuery('
            SELECT p FROM NeklesaStoreBundle:Product p, NeklesaStoreBundle:Categorylink cl
            WHERE p.id = cl.product AND cl.category = :id
        
        ')
            ->setParameter('id', $id)
            ->getResult();

        return $this->render('NeklesaStoreBundle:Default:list.html.twig',[
            'categorys'=>$rep->findBy(['parentId' => $id]),
            'perentCategory'=>$rep->find($id),
            'products'=>$products
        ]);
    }
    
    public function productAction($id){
        $doc = $this->getDoctrine();

        $product = $doc->getRepository('NeklesaStoreBundle:Product')->find($id);
        $images = $doc->getRepository('NeklesaStoreBundle:Image')->findBy(['product'=>$id]);
        $categorys = $this->getDoctrine()->getManager()
            ->createQuery('
            SELECT cat FROM NeklesaStoreBundle:Category cat, NeklesaStoreBundle:Categorylink cl
            WHERE cat.id = cl.category AND cl.product = :id
        
        ')
            ->setParameter('id', $id)
            ->getResult();

        return $this->render('NeklesaStoreBundle:Default:product.html.twig',[
            'product'=> $product,
            'images' => $images,
            'categorys' => $categorys
        ]);
    }
    
    public function crudAction(){
        return $this->render('NeklesaStoreBundle:Default:crud.html.twig');
    }
}
