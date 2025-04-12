<?php
namespace App\Services;
use App\Models\Follow;
use App\Repositories\UserRepository;
class UserService
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getUsers()
    {
        return $this->userRepository->getAll();
    }
    public function followUser(int $followerId, int $followedId)
    {
        // Verifica se o usuário está tentando seguir a si mesmo
        if ($followerId === $followedId) {
            return false;
        }

        // Verifica se o usuário já está sendo seguido
        $alreadyFollowing = Follow::where([
            'follower_id' => $followerId,
            'followed_id' => $followedId
        ])->exists();

        if ($alreadyFollowing) {
            return false;
        }

        // Cria o novo relacionamento
        return Follow::create([
            'follower_id' => $followerId,
            'followed_id' => $followedId
        ]);
    }
    public function unfollowUser(int $followerId, int $followedId)
    {
        return $this->userRepository->unfollow($followerId, $followedId);
    }
    public function getFollowing(int $userId)
    {
        return $this->userRepository->getFollowing($userId);
    }
    public function getFollowers(int $userId)
    {
        return $this->userRepository->getFollowers($userId);
    }
    public function getUserById(int $id)
    {
        return $this->userRepository->findById($id);
    }
}