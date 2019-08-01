<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeletingUserNotVertification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete users is not verification after 24h register';

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
        $arguments = $this->arguments();

        if (!empty($arguments['id'])) {
            $result = DB::table('users')->delete($arguments['id']);

            if ($result) {
                Log::info("Delete user: ID - {$arguments['id']} success");
            } else {
                Log::error("Delete user: ID - {$arguments['id']} fail");
            }

        } else {
            $users = DB::table('users')->whereNull('email_verified_at')->get();
            if (!empty($users)) {
                foreach ($users as $user) {
                    $result = DB::table('users')->delete($user->id);
                    if ($result) {
                        Log::info("Delete user: ID - {$user->id} success");
                    } else {
                        Log::error("Delete user: ID - {$user->id} fail");
                    }
                }
            }
        }
    }
}
