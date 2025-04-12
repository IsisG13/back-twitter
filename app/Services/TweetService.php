<?php
namespace App\Services;
use App\Repositories\TweetRepository;
class TweetService
{
    protected $tweetRepository;
    public function __construct(TweetRepository $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }
    public function createTweet(array $data)
    {
        return $this->tweetRepository->create($data);
    }
    public function getTweetById(int $id)
    {
        return $this->tweetRepository->findById($id);
    }
    public function getUserFeed(int $userId)
    {
        return $this->tweetRepository->getFeedForUser($userId);
    }
    public function getAllTweets()
    {
        return $this->tweetRepository->getAllTweets();
    }
}