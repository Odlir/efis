<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Layouts Class. PHP5 only.
 *
 */
class Layouts {

    // Will hold a CodeIgniter instance
    private $CI;

    // Will hold a title for the page, NULL by default
    private $title_for_layout = NULL;
    private $module_name = NULL;

    // The title separator, ' | ' by default
    private $title_separator = ' | ';
    private $includes=array();

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->helper('form');
        //$this->CI->load->model('Seguridad/modulos_model');
    }

    public function set_title($title)
    {
        $this->title_for_layout = $title;
    }

    public function set_module_name($mName)
    {
        $this->module_name = $mName;
    }

    public function view($view_name, $params = array(), $layout = 'default')
    {
        //Call Modules
        //$modulos_padres = $this->CI->modulos_model->obtenerModulosPadres();
        //$modulos_hijos = $this->CI->modulos_model->obtenerModulosHijos();

        //Ocultos
        $oculto = form_input(array('name' => 'base_url', 'type'=>'hidden', 'id' =>'base_url', 'value' => site_url()));

        // Handle the site's title. If NULL, don't add anything. If not, add a
        // separator and append the title.
        if ($this->title_for_layout !== NULL)
        {
            $separated_title_for_layout = $this->title_separator . $this->title_for_layout;
        }

        // Load the view's content, with the params passed
        $view_content = $this->CI->load->view($view_name, $params, TRUE);

        // Now load the layout, and pass the view we just rendered
        $this->CI->load->view('layouts/' . $layout, array(
            'UserImage' => base_url('img/user2-160x160.jpg'),
            'content_for_layout' => $view_content,
            'oculto' => $oculto,
            'title_for_layout' => $separated_title_for_layout,
            'module_name' => $this->module_name
        ));
    }

    public function add_include($path, $prepend_base_url = TRUE)
    {
        if ($prepend_base_url)
        {
            $this->includes[] = base_url() . $path;
        }
        else
        {
            $this->includes[] = $path;
        }

        return $this; // This allows chain-methods
    }

    public function print_includes()
    {
        // Initialize a string that will hold all includes
        $final_includes = '';

        foreach ($this->includes as $include)
        {
            // Check if it's a JS or a CSS file
            if (preg_match('/js$/', $include))
            {
                // It's a JS file
                $final_includes .= '<script type="text/javascript" src="' . $include . '"></script>';
            }
            elseif (preg_match('/css$/', $include))
            {
                // It's a CSS file
                $final_includes .= '<link href="' . $include . '" rel="stylesheet" type="text/css" />';
            }

            return $final_includes;
        }
    }
}