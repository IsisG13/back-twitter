<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $users = $this->userService->getUsers();
        return response()->json(['users' => $users]);
    }
    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return response()->json(
                ['message' => 'Usuário não encontrado'],
                404
            );
        }
        return response()->json(['user' => $user]);
    }
    public function follow($id)
    {
        $user = auth()->user();

        if ($user->id == $id) {
            return response()->json(['message' => 'Você não pode seguir a si mesmo.'], 400);
        }

        if ($user->following()->where('followed_id', $id)->exists()) {
            return response()->json(['message' => 'Você já segue este usuário.'], 400);
        }

        $user->following()->attach($id);

        return response()->json(['message' => 'Seguindo com sucesso.']);
    }

    public function unfollow($id)
    {
        $user = auth()->user();

        if (!$user->following()->where('followed_id', $id)->exists()) {
            return response()->json(['message' => 'Você não segue este usuário.'], 400);
        }

        $user->following()->detach($id);

        return response()->json(['message' => 'Deixou de seguir com sucesso.']);
    }

    public function followers($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user->followers);
    }

    public function following($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user->following);
    }

}