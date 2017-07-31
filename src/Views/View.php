<?php

namespace App\Views;

class View 
{
    protected $data;
    /**
     * Render 
     * 
     * @param string $view
     * @param type $data
     */
    public function render( string $view, $data = null )
    {
        $this->data = $data;
        $this->getTemplate( $view );
    }
    /**
     * Get Template file
     * 
     * @param type $template
     * @return type
     */
    public function getTemplate( $template )
    {
        $filename = VIEW_DIRECTORY . "/templates/{$template}.template.php";
        if ( file_exists( $filename ) ) {
            // ..
            include $filename;
        }
        return null;
    }
}
