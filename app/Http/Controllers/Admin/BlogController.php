<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Exception, App;
use \App\Article;
use \App\User;

class BlogController extends Controller {

	protected $model;
	protected $view_name = 'blog';
	protected $route_name = 'blog';

	public function __construct(\App\Article $model,\App\User $user_model)
	{
		parent::__construct();

		$this->model = $model;
		$this->user_model = $user_model;

		$this->layout->view_name = $this->view_name;
		$this->layout->route_name = $this->route_name;
		$this->page_base_dir .= $this->view_name . '.';
		
		$this->layout->content_title = strtoupper($this->view_name);

	}

	public function getIndex()
	{
		// ------------------------------------------------------------------------------------------------------------
		// WRITER LIST
		// ------------------------------------------------------------------------------------------------------------
		$writers = User::isAdmin(true)->orderBy('name')->get();
		$writer_list = $writers->lists('name', 'id');

		// ------------------------------------------------------------------------------------------------------------
		// STATUS LIST
		// ------------------------------------------------------------------------------------------------------------
		foreach (Article::statusList() as $status)
		{
			$status_list[$status] = ucwords($status);
		}
		// ------------------------------------------------------------------------------------------------------------
		// QUERY INDEX
		// ------------------------------------------------------------------------------------------------------------
		$filters = Input::only('title', 'writer', 'status');
		$q = Article::latest();
		
		if ($filters['title'])
		{
			$q = $q->findTitle('*'.$filters['title'] . '*');
		}

		if ($filters['status'])
		{
			switch (strtolower($filters['status']))
			{
				case 'published': $q = $q->published(); break;
				case 'draft'	: $q = $q->draft(); break;
				case 'upcoming'	: $q = $q->upcoming(); break;
			}
		}

		if ($filters['writer'])
		{
			$q = $q->byUser($filters['writer']);
			$filters['writer_name'] = $writers->find($filters['writer'])->name;
		}

		$data = $q->paginate();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'index')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data 			= $data;
		$this->layout->page->writer_list 	= $writer_list;
		$this->layout->page->status_list 	= $status_list;
		$this->layout->page->filters 		= $filters;

		return $this->layout;
	}

	public function getCreate($data = null)
	{
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'create')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->data					= $data;

		return $this->layout;
	}

	public function postStore($id = null)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		// handle id
		if (!is_null($id))
		{
			$data = $this->model->find($id);
		}
		else
		{
			$data 				= $this->model->newInstance();
			$data->user_id 		= Auth::id();
		}

		// ---------------------------------------- HANDLE SAVE ----------------------------------------
		$input = Input::all();
		$input['category_ids'] = $input['category'];
		$input['subarticle_ids'] = $input['subarticle'];

		if (!empty($input['published_at']))
		{
			$input['published_at'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $input['published_at'])->format('Y-m-d H:i:s');
		}
		else
		{
			unset($input['published_at']);
		}
		$data->fill($input);

		if ($data->save())
		{
			return redirect()->route('admin.'.$this->view_name.'.show', ['id' => $data->id])->with('alert_success', '"' . $data->title . '" has been saved successfully');
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($data->errors);
		}
	}

	public function getShow($id, $mode = '')
	{
		$data = $this->model->findorfail($id);

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'show')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data			= $data;
		
		return $this->layout;		
	}

	public function getEdit($id)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		$data = $this->model->findorfail($id);

		return $this->getCreate($data);
	}

	public function getDelete($id)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		$data = $this->model->findorfail($id);

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'delete')->with('route_name', $this->route_name)->with('view_name', $this->view_name);
		$this->layout->page->data			= $data;

		return $this->layout;		
	}


	public function postDelete($id)
	{
		// ---------------------------------------- HANDLE REQUEST ----------------------------------------
		// handle id
		$data = $this->model->findorfail($id);

		// ---------------------------------------- PREPARE VIEW ----------------------------------------
		if (!$data->delete())
		{
			return redirect()->back()->withErrors($data->getErrors());
		}
		else
		{
			return redirect()->route('admin.' . $this->view_name . '.index')->with('alert_success', '"' .$data->title. '" has been deleted successfully' );
		}
	}
}