<?php

namespace App\Models;

use App\Models\Post;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;


class NewsItem extends Post implements Feedable
{
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->content,
            'updated' => $this->created_at,
            'link' => url('blog/post-details/'.$this->id),
            'author' => setting()->siteName,
        ]);
    }


    public static function getFeedItems()
{
   return NewsItem::all();
}
}