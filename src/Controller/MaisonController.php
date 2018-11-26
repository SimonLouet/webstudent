<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Maison;

class MaisonController extends AbstractController
{    

    public function ajouterMaison(){
		
	// récupère le manager d'entités
        $entityManager = $this->getDoctrine()->getManager();

        // instanciation d'un objet Etudiant
        $maison = new Maison();
        $maison->setCode("SPT");
        $maison->setLibelle("Serpentard");  
        
        $maison2 = new Maison();
        $maison2->setCode("GFD");
        $maison2->setLibelle("Griffondor");   
             
        $maison3 = new Maison();
        $maison3->setCode("PFS");
        $maison3->setLibelle("Poufsouffle");    
            
        $maison4 = new Maison();
        $maison4->setCode("SRG");
        $maison4->setLibelle("Serdaigle");
        

        // Indique à Doctrine de persister l'objet
        $entityManager->persist($maison);
        $entityManager->persist($maison2);
        $entityManager->persist($maison3);
        $entityManager->persist($maison4);

        // Exécue l'instruction sql permettant de persister lobjet, ici un INSERT INTO
        $entityManager->flush();

        // renvoie vers la vue de consultation de l'étudiant en passant l'objet etudiant en paramètre
       return $this->render('maison/consulter.html.twig', [
            'pmaison' => $maison,]);
		
	}
	
	public function listerMaison() {	        
        $maisons = $this->getDoctrine()->getRepository(Maison::class)->findAll();
        
         return $this->render('maison/lister.html.twig', [
            'maisons' => $maisons,]);
	}
	
public function consulterMaison($id){
		$repository = $this->getDoctrine()->getRepository(Maison::class);
		
		$maison = $repository->findOneById($id);
		return $this->render('maison/consulter.html.twig', [
            'pMaison' => $maison,]);			
	}	
}
