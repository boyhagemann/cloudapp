<?php

class NodeController extends \BaseController {

	protected $service;

	/**
	 * @param PageService $service
	 */
	public function __construct(PageService $service)
	{
		$this->service = $service;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /page/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Node $node)
	{
		$config = $this->service->config($node);

		return View::make('nodes.edit', compact('config'));
	}

}