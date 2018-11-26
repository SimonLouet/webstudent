<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Competence;

class CompetenceController extends AbstractController
{

    public function ajouterCompetence(){
		
	// récupère le manager d'entités
        $entityManager = $this->getDoctrine()->getManager();

        // instanciation d'un objet Competence
        $competence = new Competence();
        $competence->setCode("POT");
        $competence->setLibelle("Potions");
        $competence->setNbEtudiantMax(12);
        
        $competence2 = new Competence();
        $competence2->setCode("DFM");
        $competence2->setLibelle("Défenses contre les forces du mal");
        $competence2->setNbEtudiantMax(40);
        
        $competence3 = new Competence();
        $competence3->setCode("MET");
        $competence3->setLibelle("Métamorphoses");
        $competence3->setNbEtudiantMax(20);
        
        $competence4 = new Competence();
        $competence4->setCode("BOT");
        $competence4->setLibelle("Botanique");
        $competence4->setNbEtudiantMax(40);
        
        $competence5 = new Competence();
        $competence5->setCode("AST");
        $competence5->setLibelle("Astronomie");
        $competence5->setNbEtudiantMax(40);
        
        $competence6 = new Competence();
        $competence6->setCode("DIV");
        $competence6->setLibelle("Divination");
        $competence6->setNbEtudiantMax(20);


        // Indique à Doctrine de persister l'objet
        $entityManager->persist($competence);
        $entityManager->persist($competence2);
        $entityManager->persist($competence3);
        $entityManager->persist($competence4);
        $entityManager->persist($competence5);
        $entityManager->persist($competence6);

        // Exécue l'instruction sql permettant de persister lobjet, ici un INSERT INTO
        $entityManager->flush();

        // renvoie vers la vue de consultation de l'étudiant en passant l'objet competence en paramètre
       return $this->render('competence/consulter.html.twig', [
            'competence' => $competence,]);
		
	}
	
	public function listerCompetence() {	        
        $competences = $this->getDoctrine()->getRepository(Competence::class)->findAll();
        
         return $this->render('competence/lister.html.twig', [
            'competences' => $competences,]);
	}
	
	public function consulterCompetence($id) {
         $competence = $this->getDoctrine()->getRepository(Competence::class)->find($id);
         
         return $this->render('competence/consulter.html.twig', [
            'competence' => $competence,]);
	}
}
