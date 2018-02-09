<?php

namespace App\Console\Commands;

use App\Models\Email;
use App\Mail\OpenAppEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AppOpen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resume:open';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Let users who signed up know the app is open.';

    /**
     * @var Email
     */
    protected $email;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Email $email)
    {
        parent::__construct();

        $this->email = $email;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $emails = Email::all();

        return $emails->each(function ($email) {
            return Mail::to($email->getEmail())->queue(new OpenAppEmail());
        });
    }
}
