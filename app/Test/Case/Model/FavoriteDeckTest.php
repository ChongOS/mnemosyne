<?php
App::uses('FavoriteDeck', 'Model');

/**
 * FavoriteDeck Test Case
 *
 */
class FavoriteDeckTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.favorite_deck',
		'app.user',
		'app.deck',
		'app.category',
		'app.card',
		'app.deck_tag',
		'app.tag',
		'app.score'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FavoriteDeck = ClassRegistry::init('FavoriteDeck');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FavoriteDeck);

		parent::tearDown();
	}

}
