<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'username', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'avatar',
        'profileUrl',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function getAvatar()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email) . '?s=45&d=mm';
    }

    public function getAvatarAttribute()
    {
        return $this->getAvatar();
    }

    public function getProfileUrlAttribute()
    {
        return route('user.index', $this);
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function isNot(User $user)
    {
        return $this->id !== $user->id;
    }

    public function isFollowing(User $user)
    {
        return (bool) $this->following->where('id', $user->id)->count();
    }

    public function canFollow(User $user)
    {
        if (!$this->isNot($user)) {
            return false;
        }

        return !$this->isFollowing($user);
    }

    public function canUnfollow(User $user)
    {
        return $this->isFollowing($user);
    }

    public function following()
    {
        return $this->belongsToMany('App\User', 'follows', 'user_id', 'follower_id');
    }

    public function followers()
    {
        return $this->belongsToMany('App\User', 'follows', 'follower_id', 'user_id');
    }
}
