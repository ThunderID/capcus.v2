<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class ImportSubscriber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'capcus:import_subscriber {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Suscribers from File.';

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
        //
        if (Storage::exists($this->argument('file')))
        {
            $contents = Storage::get($this->argument('file'));
            $users = json_decode($contents);

            foreach ($users as $x)
            {
                $subscriber = new \App\Subscriber();
                $subscriber->user_id = $x->user_id;
                $subscriber->email = $x->email;
                $subscriber->is_subscribe = $x->is_subscribe;
                $subscriber->save();
            }
        }
    }
}
