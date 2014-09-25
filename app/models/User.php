<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;


    const ROLE_USER = 1;          // common user can only view jobs
    const ROLE_HR = 2;            // HR can create and edit only content of the job
    const ROLE_MODERATOR = 3;     // moderator can create and edit content and state of the job

    protected static $_roles = array(
        self::ROLE_USER => 'User',
        self::ROLE_HR => 'HR',
        self::ROLE_MODERATOR => 'Moderator',
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');


    public static function getHumanReadableRole($role)
    {
        if (isset(self::$_roles[$role])) {
            return self::$_roles[$role];
        }

        return '';
    }

    public static function getRoles()
    {
        return self::$_roles;
    }
}
