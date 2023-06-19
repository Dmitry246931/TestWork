<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'name_father',
        'family',
        'phone',
        'gen',
        'address',
    ];
    public function Auto(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Auto::class, 'user_id','id');
    }
    public static function get_users()
    {
        return DB::table('users')->paginate(2);
    }

    public static function user_create($request)
    {
        DB::table('users')->insert($request->only(['family', 'name', 'name_father', 'phone', 'gen', 'address']));
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
