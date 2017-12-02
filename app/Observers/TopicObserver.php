<?php

namespace App\Observers;

use App\Jobs\TranslateSlug;
use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function saving(Topic $topic)
    {
        $topic->excerpt = make_excerpt($topic->body);
        $topic->body = clean($topic->body, 'user_topic_body');
        //翻译
        /*  if (empty($topic->slug)) {
              $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
          }*/


    }

    public function saved(Topic $topic)
    {
        if (empty($topic->slug)) {
            dispatch(new TranslateSlug($topic));
        }

    }
}