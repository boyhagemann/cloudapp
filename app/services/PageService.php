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
		Event::fire('page.dispatching', array($page));

		$content = '';

		foreach($page->nodes as $node) {
			$content .= $this->resolve($node);
		}

		Event::fire('page.dispatched', array($page, $content));

		return $content;
	}
     
    /**
     * 
     * @param Node $node
     */
    public function resolve(Node $node)
    {
		Event::fire('node.resolving', array($node));

        $url = 'http://localhost/marketplace/public/invoke/' . $node->resource;

		$data = array();

		// If this node has any children, try to resolve these child nodes
		// and assign the outcome to the right variable.
		foreach($node->children as $child) {
			$response = $this->resolve($child);
			$data[$child->variable] = is_array($response) ? $response : (string) $response;
		}

		// Combine the params together with this order:
		// - first use the resolved child node params
		// - then use the node param
		// - finally add the globel user input
		$params = array_merge(Input::all(), $node->params, $data);

        $client = new GuzzleHttp\Client;
        $response = $client->post($url, array(
            'body' => $params,
        ));

		Event::fire('node.resolved', array($node, $response));

		try {
			return $response->json();
		}
		catch(Exception $e) {
			return $response->getBody();
		}
    }

}