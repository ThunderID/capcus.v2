<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, Validator, Exception, App;
use \App\Category;

class ArticleCategoryController extends Controller {

	protected $model;
	protected $view_name = 'article_category';
	protected $route_name = 'article_category';

	public function __construct(\App\Category $model)
	{
		parent::__construct();

		$this->model = $model;

		$this->layout->view_name = $this->view_name;
		$this->layout->route_name = $this->route_name;
		$this->page_base_dir 		.= $this->layout->view_name . '.';

		$this->layout->content_title = strtoupper($this->view_name);

	}

	public function getIndex()
	{
		// ------------------------------------------------------------------------------------------------------------
		// QUERY HEADLINE
		// ------------------------------------------------------------------------------------------------------------
		$categories = Category::ofType('article')->orderby('path_name')->paginate();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'index');
		$this->layout->page->categories 	= $categories;
		$this->layout->page->view_name 		= $this->view_name;
		$this->layout->page->route_name 	= $this->route_name;

		return $this->layout;
	}

	public function getCreate($data = null)
	{
		// ------------------------------------------------------------------------------------------------------------
		// QUERY HEADLINE
		// ------------------------------------------------------------------------------------------------------------
		// $categories = Category::ofType('article')->orderby('path_name')->paginate;

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'create');
		$this->layout->page->categories 	= $data;
		$this->layout->page->view_name 		= $this->view_name;
		$this->layout->page->route_name 	= $this->route_name;

		return $this->layout;


		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.create')->with('route_name', $this->route_name)->with('view_name', $this->view_name)->with('data', $data);

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
		}

		// ---------------------------------------- HANDLE SAVE ----------------------------------------
		$input = Input::all();
		$input['type'] = 'article';

		$data->fill($input);

		if ($data->save())
		{
			return redirect()->route('admin.'.$this->view_name.'.show', ['id' => $data->id])->with('alert_success', '"' . $data->name . '" has been saved successfully');
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($data->errors);
		}
	}

	public function getShow($id, $mode = '')
	{
		$data = $this->model->findorfail($id);

		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.show')
											->with('route_name', $this->route_name)->with('view_name', $this->view_name)
											->with('data', $data);

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

		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.delete')
											->with('route_name', $this->route_name)->with('view_name', $this->view_name)
											->with('data', $data);

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
			return redirect()->route('admin.' . $this->view_name . '.index')->with('alert_success', '"' .$data->name. '" has been deleted successfully' );
		}
	}
}