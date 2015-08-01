<?php namespace App\Http\Controllers\Web;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller as BaseController;
use Auth, Route, Input;

use \App\Vendor;
use \App\Category;
use \App\PublishedArticle as Article;

abstract class Controller extends BaseController {

	protected $layout;

	function __construct()
	{
		$this->layout_base_dir 	= 'web.v1.';
		$this->page_base_dir 	= $this->layout_base_dir . 'pages.';

		// ------------------------------------------------------------------------------------------------------------
		// BASIC LAYOUT
		// ------------------------------------------------------------------------------------------------------------
		$this->layout 			= view($this->layout_base_dir.'page_templates.v1');
		$this->layout->basic 	= view($this->layout_base_dir.'page_templates.v1_content');
		$this->init_search_tour();
	}

	function init_search_tour()
	{
		// ------------------------------------------------------------------------------------------------------------
		// GET VENDOR
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->basic->vendor_db = Vendor::orderby('name')->get();

		// ------------------------------------------------------------------------------------------------------------
		// GET DESTINATION
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->basic->destination_db = Category::ofType('tour')->orderby('path_name')->get();

		// ------------------------------------------------------------------------------------------------------------
		// GET DEPARTURE LISTS
		// ------------------------------------------------------------------------------------------------------------
		$month = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		$now = \Carbon\Carbon::now();
		$departure_lists = [];
		for ($i = 1; $i <= 12; $i++)
		{
			$departure_lists[$now->year . str_pad($now->month, '2', '0', STR_PAD_LEFT)] = $month[$now->month] . ' ' . $now->year;
			$now->addMonth();
		}
		$this->layout->basic->departure_lists = $departure_lists;

		// ------------------------------------------------------------------------------------------------------------
		// GET BUDGET
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->basic->budget_list = [
												'0-999999999' 		 => "Semua budget",
												'0-1000000' 		 => "Di bawah Rp. 1.000.000",
												'1000000-2500000' 	 => "Rp. 1.000.000 - Rp. 2.500.000",
												'2500000-5000000' 	 => "Rp. 2.500.000 - Rp. 5.000.000",
												'5000000-10000000' 	 => "Rp. 5.000.000 - Rp. 10.000.000",
												'10000000-20000000'  => "Rp. 10.000.000 - Rp. 20.000.000",
												'20000000-999999999' => "Rp. 20.000.000 ke atas",
									  		];

	}

	function init_right_sidebar($mode = 'basic')
	{
		switch ($mode) {
			case 'basic':
				// ------------------------------------------------------------------------------------------------------------
				// GET LATEST ARTICLE
				// ------------------------------------------------------------------------------------------------------------
				$this->layout->page->sidebar_article = Article::latest('published_at')->take(5)->get();

				// ------------------------------------------------------------------------------------------------------------
				// TOP DESTINATION
				// ------------------------------------------------------------------------------------------------------------
				$this->layout->page->top_destination = Category::TopDestination(\Carbon\Carbon::now(), 0, 5);

				// ------------------------------------------------------------------------------------------------------------
				// Supported
				// ------------------------------------------------------------------------------------------------------------
				$this->layout->page->supported_by = Vendor::InCategories(8)->take(8)->orderBy('name')->get();

				break;
			
			default:
				# code...
				break;
		}
	}

}
