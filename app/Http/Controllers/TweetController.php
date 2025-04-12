<?php
namespace App\Http\Controllers;
use App\Services\TweetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class TweetController extends Controller
{
    protected $tweetService;
    public function __construct(TweetService $tweetService)
    {
        $this->tweetService = $tweetService;
    }
    public function store(Request $request)
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
        ];
        $tweet = $this->tweetService->createTweet($data);
        return response()->json([
            'message' => 'Tweet criado com sucesso',
            'tweet' => $tweet
        ], 201);
    }
    public function show($id)
    {
        $tweet = $this->tweetService->getTweetById($id);
        if (!$tweet) {
            return response()->json(['message' => 'Tweet não encontrado'], 404);
        }
        return response()->json(['tweet' => $tweet]);
    }
    public function feed()
    {
        $tweets = $this->tweetService->getUserFeed(auth()->id());
        return response()->json(['tweets' => $tweets]);
    }
    public function all()
    {
        $tweets = $this->tweetService->getAllTweets();
        return response()->json(['tweets' => $tweets]);
    }
}