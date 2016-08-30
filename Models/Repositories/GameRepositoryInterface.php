<?php

interface GameRepositoryInterface extends BaseRepositoryInterface {
	
    public function findGames();

	public function load();

    public function loadAll();

}