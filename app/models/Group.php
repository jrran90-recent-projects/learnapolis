<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Group extends Moloquent implements UserInterface,RemindableInterface {

	use UserTrait, RemindableTrait;

    protected $table = 'groups';

}