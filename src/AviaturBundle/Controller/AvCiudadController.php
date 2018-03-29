<?php

namespace AviaturBundle\Controller;

use AviaturBundle\Entity\AvCiudad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AvCiudadController extends Controller {

    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $avCiudad = new Avciudad();
        $avCiudads = $em->getRepository('AviaturBundle:AvCiudad')->findAll();
        $departamentos = $em->getRepository('AviaturBundle:AvDepartamento')->findAll();
        $paises = $em->getRepository('AviaturBundle:AvPais')->findAll();
        $form = $this->createForm('AviaturBundle\Form\AvCiudadType', $avCiudad);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dpto = $em->getRepository('AviaturBundle:AvDepartamento')->findOneByid(stripslashes(strip_tags($request->get('id_departamento'))));
            $avCiudad->setIdDepartamento($dpto);
            $em->persist($avCiudad);
            $em->flush();
            return $this->redirectToRoute('avciudad_index');
        }
        return $this->render('avciudad/index.html.twig', array(
                    'avCiudads' => $avCiudads,
                    'departamentos' => $departamentos,
                    'paises' => $paises,
                    'form' => $form->createView(),
        ));
    }

    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $avCiudad = new Avciudad();
        $form = $this->createForm('AviaturBundle\Form\AvCiudadType', $avCiudad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departamento = $em->getRepository('AviaturBundle:AvDepartamento')->findOneByid(stripslashes(strip_tags($request->get('id_departamento'))));
            $avCiudad->setIdDepartamento($departamento);
            $em->persist($avCiudad);
            $em->flush();

            return $this->redirectToRoute('avciudad_show', array('id' => $avCiudad->getId()));
        }

        return $this->render('avciudad/new.html.twig', array(
                    'avCiudad' => $avCiudad,
                    'form' => $form->createView(),
        ));
    }

    public function showAction(AvCiudad $avCiudad) {
        $deleteForm = $this->createDeleteForm($avCiudad);

        return $this->render('avciudad/show.html.twig', array(
                    'avCiudad' => $avCiudad,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, AvCiudad $avCiudad) {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($avCiudad);
        $editForm = $this->createForm('AviaturBundle\Form\AvCiudadType', $avCiudad);
        $editForm->handleRequest($request);
        $departamentos = $em->getRepository('AviaturBundle:AvDepartamento')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dpto = $em->getRepository('AviaturBundle:AvDepartamento')->findOneByid(stripslashes(strip_tags($request->get('id_departamento'))));
            $avCiudad->setIdDepartamento($dpto);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('avciudad_show', array('id' => $avCiudad->getId()));
        }

        return $this->render('avciudad/edit.html.twig', array(
                    'departamentos' => $departamentos,
                    'avCiudad' => $avCiudad,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, AvCiudad $avCiudad) {
        $form = $this->createDeleteForm($avCiudad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($avCiudad);
            $em->flush();
        }

        return $this->redirectToRoute('avciudad_index');
    }

    private function createDeleteForm(AvCiudad $avCiudad) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('avciudad_delete', array('id' => $avCiudad->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
