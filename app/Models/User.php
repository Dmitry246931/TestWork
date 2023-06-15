<?php

namespace App\Models;

use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'family',
        'name_father',
        'phone',
        'geh',
        'address',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function autos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Auto::class, 'user_id', 'id');
    }

    public static function get_users()
    {
        return DB::table('users')->paginate(2);
    }

    public static function user_create($request)
    {
        $user = DB::table('users')->insert($request->only(['family', 'name', 'name_father', 'phone', 'gen', 'address']));
        $user_id = DB::table('users')->where('phone', '=', $request->phone)->get('id');
        foreach ($user_id as $user => $value)
            return $value;
    }


    public static function up_user($request, $user)
    {
        DB::table('users')->where('id', '=', $user->id)->update($request->only(['family', 'name', 'name_father', 'phone'/*,'gender'*/, 'address']));
    }

    public static function delete_user($user)
    {
        DB::table('users')->where('id', '=', $user->id)->delete();
    }

    public static function get_user_count()
    {
        return DB::table('users')->count();
    }

    public static function get_users_auto($auto)
    {
        $user_id = Auto::get_user_id_avto($auto);
        $user = DB::table('users')->where('id', '=', $user_id)->value('id');

        return $user;
    }
}
