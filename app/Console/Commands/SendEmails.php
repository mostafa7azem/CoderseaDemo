<?php

namespace App\Console\Commands;

use App\Mail\SendMailable;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Contracts\Mail\Mailable;
use Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send weekly emails';

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
        $employees=Employee::where('created_at','>=', Carbon::now()->subDays(30)->toDateTimeString())->with('company')->get();
        if($employees){
            Mail::to('admin@admin.com')->send(new SendMailable($employees));
        }
    }
}
