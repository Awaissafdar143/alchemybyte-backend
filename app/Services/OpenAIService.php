<?php

namespace App\Services;

use OpenAI;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = OpenAI::client(env('OPENAI_API_KEY'));
    }

    public function generateBlogContent($prompt, $model = "gpt-4")
    {
        try {
            $response = $this->client->chat()->create([
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => 'You are an AI assistant helping with SEO content generation.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.7,
                'max_tokens' => 100,
            ]);

            return trim($response['choices'][0]['message']['content'] ?? 'No response');
        } catch (\Exception $e) {
            return "AI Error: " . $e->getMessage();
        }
    }
}
