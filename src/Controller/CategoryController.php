<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Job;

class CategoryController extends Controller
{
    /**
     * Category list
     *
     * @Route("/categories", name="categories.list")
     * @Method("GET")
     * @return Response
     */
    
    public function list() : Response
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render('category/list.html.twig', ['categories' => $categories]);
    }


    /**
     * Show category
     *
     * @Route(
     *     "/categories/{slug}/{page}",
     *     name="categories.show",
     *     defaults={"page": 1},
     *     requirements={"page" = "\d+"}
     * )
     * @Method("GET")
     * @param Category $category
     * @return Response
     */
    
    public function show(Category $category, int $page, PaginatorInterface $paginator) : Response
    {
        $activeJobs = $paginator->paginate(
            $this->getDoctrine()->getRepository(Job::class)->getPaginatedActiveJobsByCategoryQuery($category),
            $page,
            $this->getParameter('max_jobs_on_category')
        );
        return $this->render('category/show.html.twig', [
            'category' => $category,
            'activeJobs' => $activeJobs
        ]);
    }


    /**
     * Creat category
     *
     * @Route("/categories/create", name="categories.create")
     * @Method("GET")
     * @return Response
     */
    
    public function create() : Response
    {
        return $this->render('category/create.html.twig');
    }

    /**
     * Store category
     *
     * @Route("/categories/store", name="categories.store")
     * @Method("POST")
     */
    
    public function store(Request $request) : Response
    {
        //
    }
}
