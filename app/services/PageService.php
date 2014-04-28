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
		// Check if an event is returning the response early (caching)
		if($response = Event::until('node.resolving', array($node))) {
			return $response;
		}

		$data = array();

		// If this node has any children, try to resolve these child nodes
		// and assign the outcome to the right variable.
		foreach($node->children as $child) {
			$response = $this->resolve($child);

			if(!isset($data[$child->variable])) {
				$data[$child->variable] = '';
			}

			if(is_array($response)) {
				$data[$child->variable] = $response;
			}
			else {
				$data[$child->variable] .= $response;
			}

		}

		// Combine the params together with this order:
		// - first use the resolved child node params
		// - then use the node param
		// - finally add the globel user input
		$params = array_merge(Input::all(), $node->params, $data);


        $client = new GuzzleHttp\Client;
		$url = 'http://localhost/marketplace/public/invoke/' . $node->resource;
        $response = $client->post($url, array(
            'body' => $params,
        ));

		try {
			$output = $response->json();
		}
		catch(Exception $e) {
			$output = (string) View::make('nodes.show', array(
				'node' => $node,
				'body' => $response->getBody()
			));
		}

		Event::fire('node.resolved', array($node, $output));

		return $output;
    }

	/**
	 * @param Node $node
	 * @return mixed
	 */
	public function config(Node $node)
	{
		$client = new GuzzleHttp\Client;
		$url = 'http://localhost/marketplace/public/config/' . $node->resource;
		$response = $client->get($url);
		return $response->json();
	}

}