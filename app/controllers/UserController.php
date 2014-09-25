<?php
use Illuminate\Support\Facades\Auth;
class UserController extends \BaseController
{

    public function getLogin()
    {
        if (Auth::check()) {
            return Redirect::route('home');
        }

        $loginData = array(
            'email' => Input::old('email'),
            'password' => ''
        );

        return View::make('user/login')->with('loginData', $loginData);
    }

    public function login()
    {
        $userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );

        if (Auth::attempt($userdata)) {
            return Redirect::route('home');
        }

        return Redirect::guest('login');
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::guest('login');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('user/list')->with('users', User::all());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
