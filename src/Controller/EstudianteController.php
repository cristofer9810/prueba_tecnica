<?php

namespace App\Controller;

use App\Entity\Estudiantes;
use App\Form\EstudianteType;
use App\Repository\EstudiantesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class EstudianteController extends AbstractController
{
    #[Route('/jardin', name: 'app_jardin', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager,EstudiantesRepository $estudiantesRepository): Response
    {

        $estudiante = new Estudiantes();
        $form = $this->createForm(EstudianteType::class, $estudiante);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($estudiante);
            $entityManager->flush();

            return $this->redirectToRoute('app_jardin');
        }
        
        return $this->render('jardin/index.html.twig', [
            'controller_name' => 'JardinController',
            'estudiantes' => $estudiantesRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }




    #[Route('/jardin/{id}/editar', name: 'edit_estudiante', methods: ['GET', 'POST'])]
    public function edit($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $estudiante = $entityManager->getRepository(Estudiantes::class)->find($id);
        if (!$estudiante) {
             throw $this->createNotFoundException('Estudiante no encontrado'); 
        }
       
        $form = $this->createForm(EstudianteType::class, $estudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            $entityManager->flush();
            $this->addFlash('success', 'Estudiante actualizado correctamente.'); 
            return $this->redirectToRoute('app_jardin');
         }
        
        
    
        return $this->render('jardin/edit.html.twig', [
            'form' => $form->createView(),
            'estudiante' => $estudiante,
        ]);
    }

    #[Route('/jardin/{id}/eliminar', name: 'delete_estudiante', methods: ['POST'])]
    public function delete($id, EntityManagerInterface $entityManager): Response
    {
        $estudiante = $entityManager->getRepository(Estudiantes::class)->find($id);
        if ($estudiante) { 
            $entityManager->remove($estudiante); 
            $entityManager->flush(); 
            $this->addFlash('success', 'Estudiante eliminado correctamente.');
         } else {
            $this->addFlash('error', 'Estudiante no encontrado.'); 
        }

        return $this->redirectToRoute('app_jardin');
    }

    

}
