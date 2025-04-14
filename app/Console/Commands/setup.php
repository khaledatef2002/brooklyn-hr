<?php

namespace App\Console\Commands;

use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting setup process');
        $this->call('migrate');
        $this->call('storage:link');
        $this->call('key:generate');
        $this->call('config:cache');

        $student_role = Role::create(['name' => 'student']);
        $employee_role = Role::create(['name' => 'employee']);
        $admin_role = Role::create(['name' => 'admin']);
        $manager_role = Role::create(['name' => 'manager']);

        SystemSetting::create([
            'name' => 'Suhail'
        ]);

        $this->info('Setup process completed');

        $this->info('Creating admin account');

        $randomPassword = Str::random(8);
        $manager = User::create([
            'first_name' => 'Lorem',
            'last_name' => 'Lorem',
            'email' => 'admin@' . config('app.url'),
            'password' => bcrypt($randomPassword),
            'date_of_birth' => date("Y-m-d"),
            'phone_number' => "+201051461456"
        ]);

        $manager->assignRole($manager_role);

        $this->info('Manager account created with email: admin@' . config('app.url') . ' and password: ' . $randomPassword);

    }
}
