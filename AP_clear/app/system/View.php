<?php
/**
 * Ultra simple Views Class
 *
 * @author Kondratenko Alexander (Xander)
 */
namespace views;

class View
{
    function __construct()
    {
    }

    /**
     * Render indicates template by some layout
     *
     * @param string $view
     * @param array  $data
     * @param string $layout
     *
     * @author Kondratenko Alexander (Xander)
     */
    public function render($view, $data = array(), $layout = 'main.tpl')
    {
        if (is_array($data) && !empty($data))
        {
            // add GET and POST variables
            if (!empty($_GET))
            {
                $data['get'] = $_GET;
            }

            if (!empty($_POST))
            {
                $data['post'] = $_POST;
            }

            extract($data);
        }

        if (file_exists(VIEWSPATH . $view . '.php') && file_exists(LAYOUTSPATH . $layout . '.php'))
        {
            ob_start();
            include VIEWSPATH . $view . '.php';
            $_data['content'] = ob_get_contents();
            ob_end_clean();

            extract($_data);

            include LAYOUTSPATH . $layout . '.php';
        }
    }
}