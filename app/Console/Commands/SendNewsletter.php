<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use \App\Article;
use Mail;

class SendNewsletter extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'capcus:blast_newsletter';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() 
	{
		// ------------------------------------------------------------------------------------------------------------
		// GET HEADLINE
		// ------------------------------------------------------------------------------------------------------------
		$headlines = \App\Headline::with('travel_agent')->activeOn(\Carbon\Carbon::now())->orderBy('priority')->get();
		$headlines = $headlines->sortByDesc(function($data){
			return $data->travel_agent->active_packages[0]->priority;
		});

		// ------------------------------------------------------------------------------------------------------------
		// GET HOMEGRID
		// ------------------------------------------------------------------------------------------------------------
		$homegrids = \App\HomegridSetting::orderby('name')->get();

		// get upcoming package schedules
		$homegrid_destination_ids = new Collection;
		foreach ($homegrids as $k => $v)
		{
			if (str_is('destination', $v->type))
			{
				$homegrid_destination_ids->push($v->destination);
			}
		}
		if ($homegrid_destination_ids->count())
		{
			$homegrid_destinations = \App\Destination::with('tours', 'tours.schedules')->whereIn('id', $homegrid_destination_ids)->get();
			foreach ($homegrids as $k => $v)
			{
				$homegrids[$k]->destination_detail = $homegrid_destinations->find($v->destination);
			}
		}

		// ------------------------------------------------------------------------------------------------------------
		// QUERY PAKET PROMO TERBARU
		// ------------------------------------------------------------------------------------------------------------
		$tours = \App\Tour::with('destinations', 'schedules', 'destinations.images', 'places', 'places.images','travel_agent', 'travel_agent.images', 'images')
						->has('schedules')
						->select('tours.*')
						->join('travel_agencies', 'travel_agencies.id', '=', 'travel_agent_id')
						->published()
						->latest('tours.created_at')
						->limit(8)
						->groupBy('travel_agent_id')
						->get();

		// ------------------------------------------------------------------------------------------------------------
		// GET BLOG TERBARU
		// ------------------------------------------------------------------------------------------------------------
		$articles = Article::with('images')->published()->latest('published_at')->take(6)->get();

		// ------------------------------------------------------------------------------------------------------------
		// GET USER
		// ------------------------------------------------------------------------------------------------------------
		$total_subscriber = \App\Subscriber::active()->count();

		$this->info(' ---------------------------------------------------------------------------------------------- ');
		$this->info(' BLAST NEWSLETTER ');
		$this->info(' ---------------------------------------------------------------------------------------------- ');
		$this->info(' * Sending Newsletter to ' . $total_subscriber . ' subscribers');
		\App\Subscriber::with('user')->active()->orderby('id')->chunk(100, function($subscribers){
			foreach ($subscribers as $subscriber)
			{

				Mail::queue('web.v4.emails.newsletters.weekly', ['headlines' => $headlines, 
																			'homegrids' => $homegrids, 
																			'tours' => $tours, 
																			'articles' => $articles, 
																			'subscriber' => $subscriber
																		], function ($m) use ($subscriber) 
																			{
																				$m->to($subscriber->email, $subscriber->user ? $subscriber->user->name : $subscriber->email )
																					->subject('CAPCUS.id - Newsletter Edisi ' . \Carbon\Carbon::now()->year . '.' . \Carbon\Carbon::now()->format('W'));
																			}
						);
				$this->info(' * Newsletter sent to ' . $subscriber->email . ' *');
			}
		});

		$this->info(' ---------------------------------------------------------------------------------------------- ');
		$this->info(' BLAST NEWSLETTER COMPLETED');
		$this->info(' ---------------------------------------------------------------------------------------------- ');
	}
}
