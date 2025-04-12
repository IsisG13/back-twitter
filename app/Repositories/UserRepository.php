<?php
namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserRepository
{
    protected $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function create(array $data)
    {
        return $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }
    public function findById(int $id)
    {
        return $this->model->find($id);
    }
    public function getAll()
    {
        return $this->model->all();
    }
    public function follow(int $followerId, int $followedId)
    {
        $user = $this->findById($followerId);
        // Se já estiver seguindo, retorna false
        if ($user->following()->where('followed_id', $followedId)->exists()) {
            return false;
        }
        $user->following()->attach($followedId);
        return true;
    }
    public function unfollow(int $followerId, int $followedId)
    {
        $user = $this->findById($followerId);
        $user->following()->detach($followedId);
        return true;
    }
    public function getFollowing(int $userId)
    {
        $user = $this->findById($userId);
        return $user->following;
    }
    public function getFollowers(int $userId)
    {
        $user = $this->findById($userId);
        return $user->followers;
    }
}