<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,Likeable,Followable;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles($author_id)
    {
        return $this->hasMany(Article::class, $author_id);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::whereName($role)->firstOrFail();
        }

        $this->roles()->sync($role, false);
    }

    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }

    public function getAge($date)
    {
        return Carbon::parse($date)->diff(Carbon::now())->format('%y');
    }

    public function getAvatarAttribute()
    {
        return asset('storage/profile/' . $this->profile);
    }

    public function hasRole($name)
    {
        foreach ($this->roles as $role) {
            if ($role->name == $name) {
                return true;
            }
        }
        return false;
    }

    public function timeline()
    {
        if (auth()->user() == $this) {
            $ids = $this->follows()->pluck('id');
            return Article::whereIn('author_id', $ids)->orWhere('author_id', $this->id)->latest()->withlikes()->get();
        } else {
            return  Article::where('author_id', $this->id)->latest()->withlikes()->get();
        }
    }
}
