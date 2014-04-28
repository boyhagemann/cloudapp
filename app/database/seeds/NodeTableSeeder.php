<?php

class NodeTableSeeder extends Seeder {

	public function run()
	{		
        $layout = Node::create(array(
            'id' => 1,
            'page_id' => 1,
			'variable' => '',
            'resource' => '12345layout',
            'params' => array(
                'title' => 'Test title',
                'sidebar' => 'taaa',
            ),
        ));

		$newsview = Node::create(array(
			'id' => 2,
			'page_id' => 1,
			'variable' => 'content',
			'resource' => '9IAH54IY',
			'params' => array(
				'title' => 'Test title 2',
			),
		))->makeChildOf($layout);

		$newsdata = Node::create(array(
			'id' => 3,
			'variable' => 'news',
			'page_id' => 1,
			'resource' => '9IAH54IX',
			'params' => array(),
		))->makeChildOf($newsview);

		$form = Node::create(array(
			'id' => 4,
			'variable' => 'sidebar',
			'page_id' => 1,
			'resource' => '12345form',
			'params' => array(
				'title' => 'Create news',
				'action' => 'http://localhost/cloudapp/public/news/create',
				'method' => 'post',
			)
		))->makeChildOf($layout);

		$newscreate = Node::create(array(
			'id' => 5,
			'variable' => 'config',
			'page_id' => 1,
			'resource' => '12345newscreatecontract',
			'params' => array(),
		))->makeChildOf($form);




		$store = Node::create(array(
			'id' => 6,
			'page_id' => 2,
			'variable' => '',
			'resource' => '12345newsstore',
			'params' => array(),
		));

	}

}