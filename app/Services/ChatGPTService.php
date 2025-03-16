<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChatGPTService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY'); // Store API Key in .env
    }

    public function generateBlogContent($prompt)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type'  => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a blog writer. Generate a well-structured blog post.'],
                ['role' => 'user', 'content' => $prompt]
            ],
            'max_tokens' => 500,
            'temperature' => 0.7
        ]);

        return $response->json()['choices'][0]['message']['content'] ?? 'Error generating content';
    }
}
