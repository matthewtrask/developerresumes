<?php

namespace App\Console\Commands;

use App\Models\Email;
use Illuminate\Console\Command;

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
        $emails = $this->email->pluck('email');

        $emails->each(function ($email) {
            \Mail::to($email)->send(new AppOpenEmail());
        });
    }
}
