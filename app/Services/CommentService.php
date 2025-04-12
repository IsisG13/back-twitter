<?php
namespace App\Services;
use App\Repositories\CommentRepository;
class CommentService
{
    protected $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function createComment(array $data)
    {
        return $this->commentRepository->create($data);
    }
    public function getCommentsForTweet(int $tweetId)
    {
        return $this->commentRepository->getCommentsForTweet($tweetId);
    }
}