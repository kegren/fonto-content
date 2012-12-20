<?php
/**
 * Content controller
 */
namespace Content\Controller;

use Fonto\Core\Controller\Base;
use Content\Model\Entity;
use Content\Model\Form;

class Content extends Base
{
    private $baseUrl;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->baseUrl = $this->url()->baseUrl();
    }

    /**
     * Shows content overview page
     *
     * @return mixed
     */
    public function getIndexAction()
    {
        $em = $this->EntityManager();

        $data = array(
            'listAll' => $em->getRepository("Content\Model\Entity\Content")->findAll(),
            'baseUrl' => $this->baseUrl,
            'session' => $this->session()
        );

        return $this->view()->render('content/index', $data);
    }

    /**
     * Shows edit page
     *
     * @param $id
     * @return mixed
     */
    public function getEditAction($id)
    {
        $em = $this->EntityManager();

        $data = array(
            'form' => $this->form(),
            'baseUrl' => $this->baseUrl,
            'session' => $this->session(),
            'create' => false,
            'editData' => $em->getRepository("Content\Model\Entity\Content")->find($id)
        );

        return $this->view()->render('content/edit', $data);
    }

    /**
     * Process an edit request
     *
     * @return mixed
     * @throws \Exception
     */
    public function postEditAction()
    {
        $request = $this->request();
        $contentId = $request->getParameter('contentId');

        if (!$this->auth()->isAuthenticated()) {
            return $this->response()->redirect("content/edit/$contentId");
        }

        if (!is_numeric($request->getParameter('contentId'))) {
            throw new \Exception("Something went wrong.");
        }

        $session = $this->session();
        $validation = $this->validation();
        $rules = new Form\Content();
        $rules = $rules->rules();

        $validation->validate($rules, $request->getParameters());

        if ($validation->isValid()) {
            $em = $this->EntityManager();

            $user = $em->getRepository("Content\Model\Entity\User")->findOneById($this->auth()->getAuthedId());
            $content = $em->getRepository("Content\Model\Entity\Content")->findOneById($contentId);
            $content->setUser($user);
            $content->setType($request->getParameter('type'));
            $content->setTitle($request->getParameter('title'));
            $content->setSlug($this->url()->urlSlug($request->getParameter('slug')));
            $content->setData($request->getParameter('data'));
            $content->setFilter($request->getParameter('filter'));
            $content->setUpdated();
            $em->merge($content);
            $em->flush();

            $session->save('Success', 'Your content was successfully updated!');
            return $this->response()->redirect("content/edit/$contentId");
        } else {
            return $this->view()->render(
                'content/edit',
                $this->commonInclude() + array('validation' => $validation, 'create' => false)
            );
        }
    }

    /**
     * Shows content form page
     *
     * @return mixed
     */
    public function getNewAction()
    {
        return $this->view()->render('content/edit', $this->commonInclude() + array('create' => true));
    }

    /**
     * Process new content
     *
     * @return mixed
     */
    public function postNewAction()
    {
        $session = $this->session();

        if (!$this->auth()->isAuthenticated()) {
            $session->save('Error', 'You need to be logged in before you can post');
            return $this->response()->redirect('content/new');
        }

        $request = $this->request();

        $formModel = new Form\Content();
        $rules = $formModel->rules();

        $validation = $this->validation();
        $validation->validate($rules, $request->getParameters());

        if ($validation->isValid()) {
            $em = $this->EntityManager();

            $id = $this->auth()->getAuthedId();
            $user = $em->getRepository("Content\Model\Entity\User")->findOneById($id);
            $content = new Entity\Content();
            $content->setUser($user);
            $content->setType($request->getParameter('type'));
            $content->setTitle($request->getParameter('title'));
            $content->setSlug($this->url()->urlSlug($request->getParameter('slug')));
            $content->setData($request->getParameter('data'));
            $content->setFilter($request->getParameter('filter'));
            $content->setCreated();
            $content->setUpdated();
            $content->setDeleted();
            $em->persist($content);
            $em->flush();

            $session->save('Success', 'Your content was successfully created');
            return $this->response()->redirect('content/new');
        } else {
            return $this->view()->render(
                'content/edit',
                $this->commonInclude() + array('validation' => $validation, 'create' => true)
            );
        }
    }

    /**
     * @return array
     */
    private function commonInclude()
    {
        return array(
            'form' => $this->form(),
            'baseUrl' => $this->baseUrl,
            'session' => $this->session()
        );
    }
}