<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Reservation;
use App\Mail\ReservationNotification;
use Carbon\Carbon;

class SendReservationNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reservation notifications to users with reservations today';

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
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->toDateString();

        $reservations = Reservation::where('reserve_date', $today)->get();

        foreach ($reservations as $reservation) {
            $user = User::find($reservation->user_id);
            if ($user) {
                Mail::to($user->email)->send(new ReservationNotification());
            }
        }

        $this->info('Reservation notifications sent successfully!');
    }
}
