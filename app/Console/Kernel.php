<?php

namespace App\Console;

use App\Http\Controllers\ActivitiesController;
use App\Models\Registrations;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $registrations = (object)array(
                // Ayla
                array(
                    "user_id" => 1857,
                    "activity_id" => 23,
                ),
                // Gino
                array(
                    "user_id" => 3310,
                    "activity_id" => 23,
                ),
                // Daan
                array(
                    "user_id" => 3308,
                    "activity_id" => 22,
                ),
                // Seppe
                array(
                    "user_id" => 3191,
                    "activity_id" => 22,
                ),
                // Mathijs
                array(
                    "user_id" => 3188,
                    "activity_id" => 5,
                ),
                // Melody
                array(
                    "user_id" => 3207,
                    "activity_id" => 22,
                ),
                // Jeff
                array(
                    "user_id" => 3311,
                    "activity_id" => 22,
                ),
                // Senne
                array(
                    "user_id" => 1851,
                    "activity_id" => 5,
                )
            );

            foreach ($registrations as $user) {
                Registrations::create([
                    'user_id' => $user->user_id,
                    'activity_id' => $user->activity_id,
                ]);
                ActivitiesController::update($user->activity_id);
            }
        })->weekly()->tuesdays()->at('17:43')->timezone("Europe/Brussels");
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
