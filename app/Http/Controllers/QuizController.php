<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // Lấy danh sách câu hỏi từ MockAPI
    public function fetchQuestions(Request $request)
    {
        $client = new Client(['verify' => false]);
        // Lấy category và difficulty từ query parameters, đặt giá trị mặc định hợp lệ
        $category = $request->query('category', 'Geography'); // Mặc định là Geography
        $difficulty = $request->query('difficulty', 'easy');  // Mặc định là easy

        try {
            $response = $client->get('https://67eb7704aa794fb3222a5707.mockapi.io/questions', [
                'query' => [
                    'category' => $category,
                    'difficulty' => $difficulty
                ]
            ]);
            $questions = json_decode($response->getBody(), true);

            // Không yêu cầu đủ 20 câu hỏi, trả về bao nhiêu câu có sẵn
            if (empty($questions)) {
                return response()->json(['error' => 'No questions available for this category and difficulty'], 400);
            }

            return response()->json($questions);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Lưu kết quả bài thi
    public function saveResult(Request $request)
    {
        $request->validate([
            'score' => 'required|integer',
            'total_questions' => 'required|integer',
            'category' => 'required|string',
            'difficulty' => 'required|string',
        ]);

        $result = QuizResult::create([
            'user_id' => Auth::id(),
            'score' => $request->input('score'),
            'total_questions' => $request->input('total_questions'),
            'category' => $request->input('category'),
            'difficulty' => $request->input('difficulty'),
        ]);

        return response()->json(['message' => 'Result saved successfully', 'result_id' => $result->id]);
    }

    public function getUserResults()
    {
        $results = QuizResult::where('user_id', Auth::id())->get();
        return response()->json($results);
    }
}