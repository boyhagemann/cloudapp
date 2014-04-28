<?php

class PageService
{
    protected $client;
    
    public function __construct(GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

	/**
	 * @param Page $page
	 * @return string
	 */
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
        $url = 'http://localhost/marketplace/public/invoke/' . $node->resource;

		$params = $node->params;

		foreach($node->children as $child) {

			$response = $this->resolve($child);
			$params[$child->variable] = is_array($response) ? $response : (string) $response;
		}

        $client = new GuzzleHttp\Client;
        $response = $client->post($url, array(
            'body' => $params,
        ));

		try {
			return $response->json();
		}
		catch(Exception $e) {
			return $response->getBody();
		}
    }

}