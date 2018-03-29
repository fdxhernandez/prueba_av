<?php

namespace AviaturBundle\Controller;

use AviaturBundle\Entity\AvDepartamento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\AcceptHeader;
use Symfony\Component\HttpFoundation\Response;

/**
 * Avdepartamento controller.
 *
 */
class AvDepartamentoController extends Controller
{
    /**
     * Lists all avDepartamento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $avDepartamentos = $em->getRepository('AviaturBundle:AvDepartamento')->findAll();

        return $this->render('avdepartamento/index.html.twig', array(
            'avDepartamentos' => $avDepartamentos,
        ));
    }

    /**
     * Creates a new avDepartamento entity.
     *
     */
    public function newAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $avDepartamento = new Avdepartamento();
            $pais = $em->getRepository('AviaturBundle:AvPais')->findOneByid(stripslashes(strip_tags($request->get('pais'))));
            $avDepartamento->setIdPais($pais);
            $avDepartamento->setNombre(stripslashes(strip_tags($request->get('name'))));
            $em->persist($avDepartamento);
            $em->flush();
            $resultado[] = array('id' => $avDepartamento->getId(),'nombre' => $avDepartamento->getNombre());
            $response = new Response(json_encode($resultado));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

    /**
     * Finds and displays a avDepartamento entity.
     *
     */
    public function showAction(AvDepartamento $avDepartamento)
    {
        $deleteForm = $this->createDeleteForm($avDepartamento);

        return $this->render('avdepartamento/show.html.twig', array(
            'avDepartamento' => $avDepartamento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing avDepartamento entity.
     *
     */
    public function editAction(Request $request, AvDepartamento $avDepartamento)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($avDepartamento);
        $editForm = $this->createForm('AviaturBundle\Form\AvDepartamentoType', $avDepartamento);
        $editForm->handleRequest($request);
        $paises = $em->getRepository('AviaturBundle:AvPais')->findAll();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $pais = $em->getRepository('AviaturBundle:AvPais')->findOneById(stripslashes(strip_tags($request->get('pais'))));
            $avDepartamento->setIdPais($pais);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('avdepartamento_index');
        }

        return $this->render('avdepartamento/edit.html.twig', array(
            'paises'=> $paises,
            'avDepartamento' => $avDepartamento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a avDepartamento entity.
     *
     */
    public function deleteAction(Request $request, AvDepartamento $avDepartamento)
    {
        $form = $this->createDeleteForm($avDepartamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($avDepartamento);
            $em->flush();
        }

        return $this->redirectToRoute('avdepartamento_index');
    }

    /**
     * Creates a form to delete a avDepartamento entity.
     *
     * @param AvDepartamento $avDepartamento The avDepartamento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AvDepartamento $avDepartamento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('avdepartamento_delete', array('id' => $avDepartamento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
