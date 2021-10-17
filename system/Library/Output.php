<?php

namespace Lamp\Library;

class Output
{
    protected $page_title = "";
    protected $page_header;
    protected $head_end = "";
    protected $footer_end = "";
    protected $body = "";
    protected $breadcrumbs = [];
    
    
    public function addBreadcrumb($url, $text)
    {
//         $this->breadcrumbs[$url] = $text;
        $this->breadcrumbs = array_merge([
            $url => $text
        ], $this->breadcrumbs);
    }
    
    public function setBreadcrumbs($crumbs)
    {
        $this->breadcrumbs = $crumbs;
    }
    
    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }
    
    public function setPageTitle($title)
    {
        $this->page_title = $title;
        $this->page_header = $title;
        
        return $this;
    }
    
    
    public function setPageHeader($header)
    {
        $this->page_header = $header;
        
        return $this;
    }
    
    
    public function getPageHeader()
    {
        return $this->page_header;
    }
    
    public function setBodyHTML($html)
    {
        $this->body = $html;
        
        return $this;
    }
    
    public function appendToHead($str)
    {
        $this->head_end .= $str;
        
        return $this;
    }
    
    public function appendToFooter($str)
    {
        $this->footer_end .= $str;
        
        return $this;
    }
    
    
    public function getBody()
    {
        return $this->body;
    }
    
    public function getPageTitle()
    {
        return $this->page_title;
    }
    
    
    public function getHeadEnd()
    {
        return $this->head_end;
    }
    
    
    public function getFooterEnd()
    {
        return $this->footer_end;
    }
    
    
    /**
     * Send AJAX response
     *
     * Outputs and exits content, makes sure profiler is disabled
     * and sends 500 status header on error
     *
     * @access	public
     * @param	string
     * @param	bool	whether or not the response is an error
     * @return	void
     */
    public function send_ajax_response($msg, $error = false)
    {
        @header('Content-Type: application/json; charset=UTF-8');
        exit(json_encode($msg));
    }
    
}
