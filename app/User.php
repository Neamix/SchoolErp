<?php

namespace App;

use App\Http\Helpers\Mailer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\upsertTrait;
use App\Traits\validationTrait;
use App\Traits\generateToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable,upsertTrait,validationTrait,generateToken;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setLocal($local) {

        if(!in_array($local,['en','ar'])) {
            abort(404);
        }

        $user = Auth::user();
        $user->lang = $local;
        $user->save();
    }

    public function createInstance() {
        $user = User::create([]);
        return $user->updateInstance($this->toArray());
    }

    public function updateInstance($data) {
        $user = User::updateOrCreate(
            ['id' => $this->id ?? null],
            [
                'email' => $data['email'],
                'name'  => $data['name'],
                'password' => isset($data['password']) ? Hash::make($data['password']) : null,
                'grade'  => $data['grade'] ?? null,
                'type'   => $data['type'],
                'join_date' => Carbon::now(),
            ]
        );

        if( ! $data['id'] ) {
            $token = self::token($user);
            Mailer::verifyUser($user,$token);
        }

        return self::validationResult('success',__('system.user_has_been_created_successfully'));
    }

    public static function filter($request) {

        $builder = User::select('*');

        if(isset($request['name']) && ! empty($request['name'])) {
            $builder->where('name','like','%'.$request['name'].'%');
        }

        if(isset($request['type']) && ! empty($request['type'])) {
            $builder->where('type',$request['type']);
        }

        if(isset($request['active']) && ! empty($request['active'])) {
            $builder->where('active',$request['active']);
        }

        // dd($builder->toSql());

        return $builder;

    }

    public function sendPasswordResetNotification($token)
    {
        Mailer::forgetPassword($this,$token);

        return redirect('/login');
    }

    public function avatarModify($avatar) {
        $name = 'user_'.Auth::id().'.jpg';
        move_uploaded_file($avatar,public_path('assets/images/users/').$name);
        Auth::user()->avatar = $name;
        Auth::user()->save();
        return self::validationResult('success',__('validation.avatar_has_been_modified'));
    }
}
