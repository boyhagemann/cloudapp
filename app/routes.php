<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


Route::resource('pages', 'PageController');



if(!Schema::hasTable('pages')) {
	return;
}

foreach(Page::all() as $page) {
    
    $method = $page->method;
    Route::$method($page->route, function() use ($page) {        
        return App::make('PageService')->dispatch($page);        
    });
    
}

Route::model('node', 'Node');
Route::resource('node', 'NodeController');



class RedirectException extends Exception
{
	protected $response;

	public function __construct(Symfony\Component\HttpFoundation\Response $response)
	{
		$this->response = $response;
	}

	public function getResponse()
	{
		return $this->response;
	}
}


Event::listen('node.resolved', function(Node $node, $response) {

	if($node->resource == '12345newsstore') {
		$response = Redirect::to('test');
		throw new RedirectException($response);
	}

});

Event::listen('node.resolving', function(Node $node) {

	$key = $node->createCacheKey();

	if(Cache::has($key)) {
		return Cache::get($key);
	}
});

Event::listen('node.resolved', function(Node $node, $response) {

	if(!$node->cache) {
		return;
	}

	$key = $node->createCacheKey();

	Cache::put($key, $response, $node->cache);
});


App::error(function(RedirectException $e)
{
	return $e->getResponse();
});