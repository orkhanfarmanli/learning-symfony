<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class JobController extends AbstractController
{
    /**
     * List all job entries
     *
     * @Route("/", name="job.list")
     * @Method("GET")
     * @return Response
     */
    
    public function list() : Response
    {
        $jobs = $this->getDoctrine()->getRepository(Job::class)->findAll();

        return $this->render('job/list.html.twig', ['jobs' => $jobs]);
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
}
