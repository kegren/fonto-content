<?php
/**
 * Fonto - PHP framework
 *
 * @author      Kenny Damgren <kenny.damgren@gmail.com>
 * @package     Fonto.Core
 * @link        https://github.com/kenren/fonto
 * @version     0.5
 */

namespace Fonto\Core\Http;

use Fonto\Core\Http\Url;
use Fonto\Core\View\View;
use Fonto\Core\Http\Session;
use Exception;

class Response
{
    /**
     * @var \Fonto\Core\Http\Url
     */
    protected $url;

    /**
     * @var \Fonto\Core\View\View
     */
    protected $view;

    /**
     * @var array
     */
    protected $codes = array(
        200 => 'OK',
        202 => 'Accepted',
        301 => 'Moved Permanently',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not found',
        405 => 'Method Not Allowed',
        500 => 'Internal Server Error',
    );

    /**
     * @var array
     */
    protected $views = array(
        403 => 'error/403',
        404 => 'error/404'
    );

    /**
     * @var
     */
    protected $status;

    /**
     * @var
     */
    protected $contentType;

    /**
     * @var
     */
    protected $header;

    /**
     * @var Session
     */
    protected $session;


    public function __construct(Url $url, View $view, Session $session)
    {
        $this->url = $url;
        $this->view = $view;
        $this->session = $session;
    }

    /**
     * @param $url
     * @param int $code
     */
    public function redirect($url, $code = 200)
    {
        $url = $this->url->baseUrl() . $url;
        header("Location: $url");
        die;
    }

    /**
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function data($data = array())
    {
        if (!is_array($data)) {
            throw new \Exception("You can only pass an array to the data method.");
        }

        foreach ($data as $id => $value) {
            $this->session->save($id, $value);
        }

        return true;
    }

    /**
     * @param $code
     * @return mixed
     */
    public function error($code)
    {
        return $this->view->render($this->views[$code], array('e' => 'Sidan kunde inte hittas!'));
    }
}