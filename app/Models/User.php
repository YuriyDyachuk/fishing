<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\RoleEnum;
use App\Enums\MediaEnum;
use Spatie\MediaLibrary\HasMedia;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bio',
        'ban',
        'city',
        'name',
        'role',
        'email',
        'phone',
        'gender',
        'verify',
        'password',
        'birthday'
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
        'ban' => 'boolean',
        'verify' => 'boolean',
        'birthday' => 'date',
        'email_verified_at' => 'datetime'
    ];

    ############################## [RELATION METHOD] ##############################

    public function viberVerify(): HasOne
    {
        return $this->hasOne(ViberCodeVerify::class);
    }

    public function emailTokenVerify(): HasOne
    {
        return $this->hasOne(EmailTokenVerify::class);
    }

    public function reports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Report::class);
    }

    /* Friends relations */
    public function follows(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
                self::class,
                Follow::class,
                'follower_id',
                'follow_id'
                )->withPivot('confirmed')->withTimestamps();
    }

    public function followers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
                self::class,
                Follow::class,
                'follow_id',
                'follower_id'
                )->withPivot('confirmed', 'banned')->withTimestamps();
    }

    public function followersConfirm(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
                self::class,
                Follow::class,
                'follow_id',
                'follower_id'
                )->withPivot('confirmed', 'banned')->wherePivot('confirmed', true);
    }
    /* End friends relations */

    ##############################  [CUSTOM METHOD]  ##############################

    public function isVerify(): bool
    {
        return (bool) $this->verify;
    }

    public function isAdmin(): bool
    {
        return $this->role === RoleEnum::ADMIN()->value;
    }

    public function isModerator(): bool
    {
        return $this->role === RoleEnum::MODERATOR()->value;
    }

    public function isUser(): bool
    {
        return $this->role === RoleEnum::CUSTOMER()->value;
    }

    public function isFollowConfirm(int $userId): bool
    {
        return $this->followers()
                    ->where([
                        'follower_id' => $userId,
                        'confirmed' => true,
                        'banned' => false
                    ])->exists();
    }

    public function getIdFollower(): array
    {
        return $this->followersConfirm()->pluck('follower_id')->toArray();
    }

    public function isFollow(int $userId): bool
    {
        return $this->followers()->where(['follower_id' => $userId])->exists();
    }

    public function isFollower(int $userId): bool
    {
        return $this->follows()->where(['follow_id' => $userId])->exists();
    }

    public function isFollowBanned(int $userId): bool
    {
        return $this->follows()->where(['follow_id' => $userId, 'banned' => true])->exists();
    }

    public function isActiveSendFollowing(int $userId): bool
    {
        return $this->follows()->where(['follow_id' => $userId, 'confirmed' => false])->exists();
    }

    public function isConfirmFollowersCount(): int
    {
        return $this->follows()->where(['confirmed' => true])->count();
    }

    public function age(): ?int
    {
        return !is_null($this->birthday) ? $this->birthday->diffInYears(\Carbon\Carbon::now()) : null;
    }

    public function isAdminBanned(): bool
    {
        return $this->ban;
    }

    //================================== [CUSTOM METHODS MEDIA LIBRARY] ==================================#

    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('small')
             ->width(80)
             ->height(80);
    }
}
