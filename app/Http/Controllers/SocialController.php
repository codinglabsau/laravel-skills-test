<?php
 
namespace App\Http\Controllers;
 
use Socialite;
use App\Models\User;

class SocialController extends Controller{

    public function redirect($social){

        return Socialite::driver($social)->redirect();
    }

    public function callback($social){

        $getInfo = Socialite::driver($social)->stateless()->user();

        //Response is array of USER,REDIRECT,FLASH MSG
        $user = $this->createUser($getInfo,$social);

        if($user){
            auth()->login($user);
            return redirect('/dashboard');
        }
        else{
            return redirect('/login');
        }
    }


    function createUser($getInfo,$social){

        $user = User::where('email', $getInfo->email)->first();
       
        if (!$user) {
            
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'email_verified_at' => time(),
                'provider' => $social,
                'provider_id' => $getInfo->id
            ]);
        }

        return $user;
    }

}

