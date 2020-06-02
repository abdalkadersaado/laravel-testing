<?php

namespace App\Console\Commands;

use App\User;
use App\Mail\NotifyEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $users= User::where('expire',0)->get(); //collection of users
        foreach($users as $user)
        {
            $user->update(['expire'=>1]);

        }

        $emails = User::pluck('email')->toArray();

        $data = ['title' =>'Warnning' , 'body'=>'this subscribe is expiration >>>'] ;

        foreach($emails as $email) 
        {
            Mail::To($email)->send(new NotifyEmail($data));

        }
    }
}
