<?php
namespace App\Http\Controllers;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CommentController extends Controller
{
    protected $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function store(Request $request, $tweetId)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:280',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = [
            'content' => $request->content,
            'user_id' => auth()->id(),
            'tweet_id' => $tweetId,
        ];
        $comment = $this->commentService->createComment($data);
        return response()->json([
            'message' => 'Comentário adicionado com sucesso',
            'comment' => $comment
        ], 201);
    }
    public function index($tweetId)
    {
        $comments = $this->commentService->getCommentsForTweet($tweetId);
        return response()->json(['comments' => $comments]);
    }
}