<?php
namespace App\Repositories;
use App\Models\Comment;
class CommentRepository
{
    protected $model;
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }
    public function create(array $data)
    {
        return $this->model->create([
            'content' => $data['content'],
            'user_id' => $data['user_id'],
            'tweet_id' => $data['tweet_id'],
        ]);
    }
    public function getCommentsForTweet(int $tweetId)
    {
        return $this->model->where('tweet_id', $tweetId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}