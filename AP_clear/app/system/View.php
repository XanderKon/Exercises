<?php
/**
 * Ultra simple Views Class
 *
 * @author Kondratenko Alexander (Xander)
 */
namespace views;

class View
{
    public $content;

    /**
     * Render indicates template & add variables
     *
     * @param string $view
     * @param array  $data
     * @param string $layout
     *
     * @author Kondratenko Alexander (Xander)
     */
    function render($view, $data = array(), $layout = 'main.tpl')
    {
        if (is_array($data) && !empty($data))
        {
            extract($data);
        }

        if (file_exists(VIEWSPATH . $view . '.php'))
        {
            ob_start();
            include VIEWSPATH . $view . '.php';
            $this->content = ob_get_contents();
            ob_end_clean();

            extract($content['content'] = $this->content);

            include LAYOUTSPATH . $layout . '.php';
        }
    }
}