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

class Auto extends Model
{
    use HasFactory;
    protected $table = 'autos';
    protected $fillable = [
        'mark',
        'model',
        'color',
        'gos_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function auto_create($request, $user)
    {
        return DB::table('autos')->insert(['mark' => $request->get('mark'),
            'model' => $request->get('model'),
            'color' => $request->get('color'),
            'gos_number' => $request->get('gos_number'),
            'user_id' => $user->id,]);
    }

    public static function show_autos($user)
    {
        $autos = DB::table('autos')->where('user_id', '=', $user->id)->get();
        return $autos;
    }

    public static function up_auto($request, $auto)
    {
        DB::table('autos')->where('id', '=', $auto->id)->update($request->only(['mark', 'model', 'color', 'gos_number']));
    }

    public static function delete_auto($auto)
    {
        DB::table('autos')->where('id', '=', $auto)->delete();
    }

    public static function au_where_us($user)
    {
        $autos = DB::table('autos')->where('user_id', '=', $user->id)->get();
        return $autos;
    }

    public static function on_parking()
    {
        $auto = DB::table('autos')->where('status', '=', 1)->get();
        return $auto;
    }

    public static function off_parking($parentId)
    {
        $auto = DB::table('autos')->where('user_id', $parentId)->where('status', '=', 0)->get();
        return $auto;
    }

    public static function status_on($request)
    {
        $auto = DB::table('autos')->where('id', '=', $request->subcategory_id)->update(['status' => 1]);
        return $auto;
    }

    public static function status_off($aut)
    {
        $auto = DB::table('autos')->where('id', '=', $aut->id)->update(['status' => 0]);
        return $auto;
    }

    public static function get_auto_count($auto)
    {
        $user_id = DB::table('autos')->where('id', '=', $auto)->value('user_id');
        $user_count_auto = DB::table('autos')->where('user_id', '=', $user_id)->count();
        return $user_count_auto;
    }

    public static function get_user_id_auto($auto)
    {
        return DB::table('autos')->where('id', '=', $auto)->value('user_id');
    }
}
