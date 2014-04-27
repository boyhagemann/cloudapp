<?php

class PageService
{
    protected $client;
    
    public function __construct(GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    public function dispatch(Page $page)
     {       
        $content = '';
        
         foreach($page->nodes as $node) {
             $content .= $this->resolve($node);             
         }
         
         return $content;         
     }
     
    /**
     * 
     * @param Node $node
     */
    public function resolve(Node $node)
    {
        $url = 'http://localhost/marketplace/public/resolve/' . $node->resource;

        $client = new GuzzleHttp\Client;
        $response = $client->post($url, array(
            'body' => $node->params,
        ));
        
        return $response->getBody();
    }

}