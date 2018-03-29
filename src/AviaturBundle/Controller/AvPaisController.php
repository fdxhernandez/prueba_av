<?php

namespace AviaturBundle\Controller;

use AviaturBundle\Entity\AvPais;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\AcceptHeader;
use Symfony\Component\HttpFoundation\Response;
/**
 * Avpai controller.
 *
 */
class AvPaisController extends Controller {

    /**
     * Lists all avPai entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $avPais = $em->getRepository('AviaturBundle:AvPais')->findAll();

        return $this->render('avpais/index.html.twig', array(
                    'avPais' => $avPais,
        ));
    }

    /**
     * Creates a new avPai entity.
     *
     */
    public function newAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $avPai = new Avpais();
            $em = $this->getDoctrine()->getManager();
            $avPai->setNombre(stripslashes(strip_tags($request->get('name'))));
            $em->persist($avPai);
            $em->flush();
            $resultado[] = array('id' => $avPai->getId(),'nombre' => $avPai->getNombre());
            $response = new Response(json_encode($resultado));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

    

    /**
     * Displays a form to edit an existing avPai entity.
     *
     */
    public function editAction(Request $request, AvPais $avPai) {
        $deleteForm = $this->createDeleteForm($avPai);
        $editForm = $this->createForm('AviaturBundle\Form\AvPaisType', $avPai);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('avpais_index');
        }

        return $this->render('avpais/edit.html.twig', array(
                    'avPai' => $avPai,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a avPai entity.
     *
     */
    public function deleteAction(Request $request, AvPais $avPai) {
        $form = $this->createDeleteForm($avPai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($avPai);
            $em->flush();
        }

        return $this->redirectToRoute('avpais_index');
    }

    /**
     * Creates a form to delete a avPai entity.
     *
     * @param AvPais $avPai The avPai entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AvPais $avPai) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('avpais_delete', array('id' => $avPai->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
