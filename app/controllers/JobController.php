<?php

class JobController extends \BaseController
{

    public function __construct()
    {
        parent::__construct();

        View::share('userPermissions', Auth::check() ? Auth::user()->role : 0);
        View::share('authUser', Auth::user());

        $this->beforeFilter('permission', array('only' => array('create', 'edit')));
        $this->beforeFilter('auth', array('except' => array('getLogin', 'login')));
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $jobs = Job::where('state', Job::STATE_PUBLISHED);

        if (Auth::user()->role == User::ROLE_MODERATOR) {
            $jobs->orWhere('state', Job::STATE_PENDING);
            $jobs->orWhere('state', Job::STATE_DECLINED);
        }

		return View::make('job/list')
            ->with('jobs', $jobs->get());

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $job = new Job;
        $job->title = Input::old('title');
        $job->email = Input::old('email');
        $job->description = Input::old('description');

        return View::make('job/create')->with('job', $job);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $this->_validate();

        $inputData = Input::all();

        $job = new Job();
        $job->title = $inputData['title'];
        $job->email = $inputData['email'];
        $job->description = isset($inputData['description']) ? $inputData['description'] : '';
        $job->user_id = Auth::user()->id;
        $job->save();

        // notify publisher about moderation process
        $this->_sendMailToPublisherAboutJob($job);

        // notify all moderators about publish event
        $this->_sendMailToModeratorAboutJob($job);

        return Redirect::route('job.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Job $job
	 * @return Response
	 */
	public function show(Job $job)
	{
		return View::make('job/show')->with(array('job' => $job));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Job $job
	 * @return Response
	 */
	public function edit(Job $job)
	{
        if (Auth::user()->role == User::ROLE_MODERATOR || Auth::user()->id == $job->user_id) {
            return View::make('job/edit')
                ->with('job', $job)
                ->with('jobStates', Job::getStates());
        }

        return Redirect::route('home');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Job $job
	 * @return Response
	 */
	public function update(Job $job)
	{
        $this->_validate();

        $inputData = Input::all();

        $job->title = $inputData['title'];
        $job->email = $inputData['email'];
        if (isset($inputData['description'])) {
            $job->description = $inputData['description'];
        }
        if (isset($inputData['state'])) {
            $job->state = $inputData['state'];
        }
        $job->save();

        return Redirect::route('job.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Job $job
	 * @return Response
	 */
	public function destroy(Job $job)
	{
        $job->delete();

        return Redirect::route('job.index');
	}

    /**
     * Notify publisher about moderation process
     *
     * @param Job $job
     * @return bool
     */
    protected function _sendMailToPublisherAboutJob(Job $job)
    {
        try {
            Mail::send('emails/notify_hr', array('job' => $job), function($message) {
                $message->to(Auth::user()->email, Auth::user()->name)->subject('Your submission is in moderation');
            });
        } catch(\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Notify all moderators about publish event
     *
     * @param Job $job
     * @return bool
     */
    protected function _sendMailToModeratorAboutJob(Job $job)
    {
        $moderators = User::where('role', User::ROLE_MODERATOR)->get();

        foreach ($moderators as $moderator) {
            try {
                Mail::send('emails/notify_moderator', array('job' => $job), function($message) use ($moderator) {
                    $message->to($moderator->email, $moderator->name)->subject('Please verify the submission from ' . Auth::user()->name);
                });
            } catch(\Exception $e) {
                continue;
            }
        }

        return true;
    }

    /**
     * Validate before create/update
     *
     * @return mixed
     */
    protected function _validate()
    {
        $inputData = Input::all();
        $rules = array(
            'title' => 'required',
            'email' => 'required|email'
        );

        $validator = Validator::make($inputData, $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $arrayForFlash = array();
            foreach ($inputData as $key => $data) {
                if (!$messages->has($key)) {
                    $arrayForFlash[] = $key;
                }
            }
            call_user_func_array(array('Input', 'flashOnly'), $arrayForFlash);

            return Redirect::route('job.create')->withErrors($validator);
        }
    }
}
