<?php

namespace Neklesa\ApiBundle\Controller;

use FOS\RestBundle\Routing\ClassResourceInterface;
use Neklesa\StoreBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;



class ProductController extends FOSRestController implements ClassResourceInterface
{
    public function getProductAction($product_id){
        /*
         * Осторожно костыли
         */
        $product = $this->getDoctrine()->getRepository('NeklesaStoreBundle:Product')->find($product_id);
        if($product===null)
            return new View("Not found", Response::HTTP_NOT_FOUND);
        $categorys = $this->getDoctrine()->getManager()
            ->createQuery('
            SELECT cat.name, cl.id FROM NeklesaStoreBundle:Category cat, NeklesaStoreBundle:Categorylink cl
            WHERE cat.id = cl.category AND cl.product = :id
        
        ')
            ->setParameter('id', $product_id)
            ->getResult();
        $images = $this->getDoctrine()->getRepository('NeklesaStoreBundle:Image')
            ->findBy(['product'=>$product->getId()]);

        //костыль

        $finalarray = [];
        $finalarray['id']=$product->getId();
        $finalarray['name']=$product->getName();
        $finalarray['price']=$product->getPrice();

        $finalarray['images']= [];
        foreach ($images as $image){
            $temp['url']='/assets/image/product_image/'.$image->getUrl();
            $temp['id']=$image->getId();
            $finalarray['images'][] = $temp;
        }
        $finalarray['categorys']=[];
        foreach ($categorys as $category){

            $finalarray['categorys'][] = $category;
        }
        return $finalarray;
    }
}
