<?php
/**
 * Page controller
 */
namespace Content\Controller;

use Fonto\Core\Controller\Base;
use Content\Model\Entity;
use Content\Model\Form;
use Exception;

class Page extends Base
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Shows a page based on id
     *
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function getViewAction($id)
    {
        if (!is_numeric($id)) {
            throw new Exception("The id most be numeric");
        }
        $em = $this->EntityManager();

        $data = array(
            'page' => $em->getRepository("Content\Model\Entity\Content")->findOneById($id),
            'baseUrl' => $this->url()->baseUrl(),
            'session' => $this->session()
        );

        return $this->view()->render('page/index', $data);
    }
}