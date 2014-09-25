<?php

class UserComposer
{
    public function compose($view)
    {
        if (Auth::check()) {
            $view->with('isAuthorized', true)
                 ->with('authUser', Auth::user())
                 ->with('isEditableMode', Auth::user()->role == User::ROLE_MODERATOR);
        } else {
            $view->with('isAuthorized', false)
                 ->with('isEditableMode', false);
        }
    }
}