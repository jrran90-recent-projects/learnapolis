<?php

class MessageController extends BaseController {

	public function showMessage() {
		return View::make('messages');
	}



}