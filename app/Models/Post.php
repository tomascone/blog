<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class Post extends Model implements Feedable
{
    use HasFactory;

    protected $with = ['category', 'author'];



    public static function boot()
    {
        parent::boot();

        self::created(function ($post) {
            $post->sendNotificationMailToFollowers();
        });

        self::updated(function ($post) {
            $post->sendNotificationMailToFollowers();
        });
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
        $query->where(fn ($query) =>
        $query->where('title', 'like', '%' . $search . '%')
            ->orwhere('body', 'like', '%' . $search . '%')));

        $query->when($filters['category'] ?? false, fn ($query, $category) =>
        $query
            ->whereHas('category', fn ($query) =>
            $query->where('slug', $category)));

        $query->when($filters['author'] ?? false, fn ($query, $author) =>
        $query
            ->whereHas('author', fn ($query) =>
            $query->where('username', $author)));
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function increseViews()
    {
        if (!Auth::check()) {
            $cookie_name = (Str::replace('.', '', (request()->ip())) . '-' . $this->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $this->id);
        }

        if (!Cookie::get($cookie_name)) {
            $this->increment('views');
            return cookie($cookie_name, '1', 60);;
        }

        return Cookie::get($cookie_name);
    }

    public function sendNotificationMailToFollowers()
    {
        if ($this->status) {
            $emails = User::whereIn('id', $this->author->followed->pluck('user_id'))->pluck('email')->toArray();
            $subject = ucfirst(auth()->user()->name) . ' has published a new post';

            Mail::send('emails.new-post', $this->toArray(), function ($message) use ($emails, $subject) {
                $message->to($emails)->subject($subject);
                $message->from(config('mail.mailers.smtp.username'), 'Blog');
            });

            return true;
        }

        return false;
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->excerpt)
            ->updated($this->updated_at)
            ->link($this->slug)
            ->author($this->author->name);
    }

    public static function getFeedItems()
    {
        return Post::all();
    }
}
