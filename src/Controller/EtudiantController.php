<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Form\EtudiantModifierType;

class EtudiantController extends AbstractController
{	
	public function ajouterEtudiant(Request $request){
		$etudiant = new etudiant();
		$form = $this->createForm(EtudiantType::class, $etudiant);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$etudiant = $form->getData();

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($etudiant);
			$entityManager->flush();

			return $this->render('etudiant/consulter.html.twig', ['etudiant' => $etudiant,]);
		} else {
			return $this->render('etudiant/ajouter.html.twig', array('form' => $form->createView(),));
		}
	}
	
	public function listerEtudiant() {	        
        $etudiants = $this->getDoctrine()->getRepository(Etudiant::class)->findAll();
        
         return $this->render('etudiant/lister.html.twig', [
            'etudiants' => $etudiants,]);
	}
	
	public function consulterEtudiant($id) {
         $etudiant = $this->getDoctrine()->getRepository(Etudiant::class)->find($id);
         
         return $this->render('etudiant/consulter.html.twig', [
            'etudiant' => $etudiant,]);
	}
	
	public function modifierEtudiant($id, Request $request){
		//récupération de l'étudiant dont l'id est passé en paramètre
		$etudiant = $this->getDoctrine()->getRepository(Etudiant::class)->find($id);

		if (!$etudiant) {
			throw $this->createNotFoundException('Aucun etudiant trouvé avec le numéro '.$id);
		} else {
			$form = $this->createForm(EtudiantModifierType::class, $etudiant);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {

				$etudiant = $form->getData();
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($etudiant);
				$entityManager->flush();
				return $this->render('etudiant/consulter.html.twig', ['etudiant' => $etudiant,]);
			} else {
				return $this->render('etudiant/ajouter.html.twig', array('form' => $form->createView(),));
			}
		}
	}
}
