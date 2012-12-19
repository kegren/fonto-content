<?php
/**
 * User controller
 */
namespace Content\Controller;

use Fonto\Core\Controller\Base;
use Content\Model\Entity;
use Content\Model\Form;

class User extends Base
{
    /**
     * @var Base url
     */
    protected $baseUrl;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->baseUrl = $this->url()->baseUrl();
    }

    /**
     * Shows profile page if authenticated
     *
     * @return mixed
     */
    public function getProfileAction()
    {
        if (!$this->auth()->isAuthenticated()) {
            $this->response()->redirect('user/login');
        }

        $userData = $this->session()->get('user');
        $id = $userData['id'];

        $user = $this->EntityManager()->getRepository('Content\Model\Entity\User')->findOneById($id);
        $data = array(
            'baseUrl' => $this->baseUrl,
            'form' => $this->form(),
            'session' => $this->session(),
            'user' => $user
        );

        return $this->view()->render('user/profile', $data);
    }

    /**
     * Updates a user profile
     */
    public function postProfileAction()
    {
        $session = $this->session();
        $request = $this->request();
        $validation = $this->validation();
        $em = $this->EntityManager();

        $formModel = new Form\Profile();

        $validation->validate($formModel->rules(), $request->getParameters());

        $user = $em->getRepository('Content\Model\Entity\User')->findOneById($this->auth()->getAuthedId());

        if ($validation->isValid()) {
            $user->populate(
                array(
                    'username' => $request->getParameter('username'),
                    'password' => $this->hash()->hashPassword($request->getParameter('password')),
                    'email' => $request->getParameter('email'),
                    'name' => $request->getParameter('name')
                )
            );
            $em->merge($user);
            $em->flush();

            $session->save('Success', 'Your profile has been updated!');
            $this->response()->redirect('user/profile');
        } else {
            $session->save('Error', 'Error!');
            $this->view()->render(
                'user/profile',
                array(
                    'baseUrl' => $this->baseUrl,
                    'form' => $this->form(),
                    'session' => $session,
                    'user' => $user,
                    'validation' => $validation
                )
            );
        }

    }

    /**
     * Shows login page
     *
     * @return mixed
     */
    public function getLoginAction()
    {
        return $this->view()->render(
            'user/login',
            array(
                'baseUrl' => $this->baseUrl,
                'form' => $this->form(),
                'auth' => $this->auth(),
                'session' => $this->session()
            )
        );
    }

    /**
     * Process login action
     *
     * @return mixed
     */
    public function postLoginAction()
    {
        $request = $this->request();
        $auth = $this->auth();
        $session = $this->session();

        if ($request->isPost()) {
            $auth->setEntityManager($this->EntityManager());
            $auth->setModel(new Entity\User());

            if ($auth->login($request->getParameters())) {
                return $this->response()->redirect('user/profile');
            } else {
                $session->save('Error', 'Username / password incorrect');
                return $this->view()->render(
                    'user/login',
                    array(
                        'baseUrl' => $this->baseUrl,
                        'form' => $this->form(),
                        'auth' => $this->auth(),
                        'session' => $this->session()
                    )
                );
            }
        }
    }

    /**
     * Shows registration page
     *
     * @return mixed
     */
    public function getRegisterAction()
    {
        return $this->view()->render(
            'user/register',
            array(
                'baseUrl' => $this->baseUrl,
                'form' => $this->form(),
                'auth' => $this->auth(),
                'session' => $this->session()
            )
        );
    }

    /**
     * Process registration action
     *
     * @return mixed
     */
    public function postRegisterAction()
    {
        $session = $this->session();
        $request = $this->request();

        $validation = $this->validation();
        $formModel = new Form\Register();
        $rules = $formModel->rules();

        $validation->validate($rules, $request->getParameters());

        if ($validation->isValid()) {
            $em = $this->EntityManager();

            $user = new Entity\User();
            $user->populate(
                array(
                    'username' => $request->getParameter('username'),
                    'password' => $this->hash()->hashPassword($request->getParameter('password')),
                    'email' => $request->getParameter('email'),
                    'name' => $request->getParameter('name')
                )
            );
            $em->persist($user); // Start monitoring
            $em->flush(); // Save

            $role = new Entity\UserRole();
            $role->setUserId($user->getId());
            $role->setRoleId(2); // Regular user as default
            $em->persist($role);
            $em->flush();

            $session->save('Success', 'Welcome as an member ' . $user->getName() . ', use the form below to sign in!');
            return $this->response()->redirect('user/login');
        } else {
            return $this->view()->render(
                'user/register',
                array(
                    'baseUrl' => $this->baseUrl,
                    'form' => $this->form(),
                    'auth' => $this->auth(),
                    'session' => $this->session(),
                    'validation' => $validation
                )
            );
        }
    }

    /**
     * Logs a user out
     *
     * @return mixed
     */
    public function getLogoutAction()
    {
        $this->auth()->logout();
        $this->session()->save('Success', 'You are now logged out');
        return $this->response()->redirect('user/login');
    }
}