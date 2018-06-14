<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Job;
use App\Entity\Category;

class JobController extends AbstractController
{
    /**
     * List all job entries
     *
     * @Route("/", name="job.list")
     * @Method("GET")
     * @return Response
     */
    public function list(EntityManagerInterface $em) : Response
    {
        // $jobs = $this->getDoctrine()->getRepository(Job::class)->findAll();
        // $query = $em->createQuery(
        //     'SELECT j from App:Job j WHERE j.expiresAt > :date'
        // )->setParameter('date', new \DateTime('-30 days'));

        // $jobs = $query->getResult();

        // $jobs = $em->getRepository(Job::class)->findActiveJobs();

        $categories = $em->getRepository(Category::class)->findWithActiveJobs();


        return $this->render('job/list.html.twig', ['categories' => $categories]);
    }

    /**
     * Show just one job
     *
     * @Route("/job/{id}", name="job.show", requirements={"id"="\d+"})
     * @Method("GET")
     *
     * @param Job $job
     *
     * @return Response
     */
    
    public function show(Job $job) : Response
    {
        return $this->render('job/show.html.twig', ['job' => $job]);
    }

    /**
     *  Create a job page
     *
     * @Route("/job/create", name="job.create")
     * @Method("GET")
     */
    
    public function create() : Response
    {
        return $this->render('job/create.html.twig');
    }


    /**
     * Store job
     *
     * @Route("/job/store", name="job.store")
     * @Method("POST")
     */
    
    public function store() : Job
    {
        return "test";
    }
}
