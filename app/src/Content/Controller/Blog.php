<?php
/**
 * Blog controller
 */
namespace Content\Controller;

use Fonto\Core\Controller\Base;
use Content\Model\Entity;
use Content\Model\Form;

class Blog extends Base
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Default index action
     *
     * @return mixed
     */
    public function getIndexAction()
    {
        $em = $this->EntityManager();

        $data = array(
            'listAll' => $em->getRepository("Content\Model\Entity\Content")->findBy(array('type' => 'post')),
            'baseUrl' => $this->url()->baseUrl(),
            'session' => $this->session()
        );

        return $this->view()->render('blog/index', $data);
    }
}