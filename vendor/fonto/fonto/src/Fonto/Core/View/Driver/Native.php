<?php
/**
 * Fonto - PHP framework
 *
 * @author      Kenny Damgren <kenny.damgren@gmail.com>
 * @package     Fonto.Core
 * @link        https://github.com/kenren/fonto
 * @version     0.5
 */

namespace Fonto\Core\View\Driver;

use Fonto\Core\View\Driver\DriverInterface;
use Fonto\Core\Application\ObjectHandler;

use Exception;

class Native extends ObjectHandler implements DriverInterface
{
    /**
     * @var string
     */
    protected $extension = '.php';

    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $data = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = VIEWPATH;
    }

    public function post($field)
    {
        return isset($_POST[$field]) ? $_POST[$field] : '';
    }

    /**
     * Filters output based on key
     *
     * @param $data
     * @param $filter
     * @return string
     */
    public function filter($data, $filter)
    {
        switch($filter) {
            case 'purifier':
                $data = nl2br($this->purify($data));
                break;
            case 'bbcode':
                $data = nl2br($this->bbcode(_e($data)));
                break;
            case 'plain':
                $data = nl2br(_e($data));
                break;
            default:
                $data = nl2br(_e($data));
        }

        return $data;
    }

    /**
     * Helper, BBCode formatting converting to HTML.
     *
     * @param string text The text to be converted.
     * @return mixed
     * @return string the formatted text.
     */
    function bbcode($text) {
        $search = array(
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](https?.*?)\[\/img\]/is',
            '/\[url\](https?.*?)\[\/url\]/is',
            '/\[url=(https?.*?)\](.*?)\[\/url\]/is'
        );
        $replace = array(
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" />',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
        );
        return preg_replace($search, $replace, $text);
    }

    /**
     * Loads a view
     *
     * @param $view
     */
    public function load($view)
    {
        echo $this->render($view, $this->data);
    }

    /**
     * Uses purifier
     *
     * @param $data
     * @return mixed
     */
    public function purify($data)
    {
        $purifier = $this->purifier();
        return $purifier->purify($data);
    }

    /**
     * Uses renderView
     *
     * @param $view
     * @param array $data
     * @return mixed|string
     */
    public function render($view, $data = array())
    {
        return $this->renderView($view, $data);
    }

    /**
     * Renders a view with data
     *
     * @param $view
     * @param array $data
     * @return string
     * @throws \Exception
     */
    public function renderView($view, $data = array())
    {
        $view = strtolower($view);
        ob_start(); // Start output buffering

        if (!empty($data)) {
            $this->data = $data;
            extract($data);
            unset($data); // Remove from local
        }

        if ($this->findView($view, $this->path, $this->extension)) {
            require $this->path . $view . $this->extension;
            $view = ob_get_clean(); // Gets buffer and clears it
            return $view;
        } else {
            ob_end_clean();
            throw new Exception("The view file, {$view} wasn't found.");
        }
    }

    /**
     * Checks if a view file exists
     *
     * @param $view
     * @param $path
     * @param $extension
     * @return bool|mixed
     */
    public function findView($view, $path, $extension)
    {
        if (file_exists($path . $view . $extension)) {
            return true;
        }

        return false;
    }

    /**
     * @param $file
     * @return string
     */
    protected function getContent($file)
    {
        return "<pre>" . htmlentities(file_get_contents($file)) . "</pre>";
    }
}