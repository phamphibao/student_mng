<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Model\User;
use App\Model\Roles;
use App\Model\Message;
class UserSeeder extends Seeder
{
    protected $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'birth_day' => '1998-03-05',
            'gender' => '1',
            'key' => 'isAdmin',
        ]);
        
        factory(App\Model\User::class, 11)->create();
        
        $roles = Roles::all();

        App\Model\User::All()->each(function ($user) use ($roles){
            $user->roles()->attach(
                $roles->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });
       
        factory(App\Model\Message::class, 300)->create();
      

       
    }
}
