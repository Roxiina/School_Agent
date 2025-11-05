<?php
namespace SchoolAgent\Controllers\front;

class IaController
{
    private $apiKey;

    public function __construct()
    {
        // Charge le config ici dans le constructeur
        $config = require __DIR__ . '/../../../config.php';
        $this->apiKey = $config['GROQ_API_KEY'];
    }

    public function index()
    {
        $response = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['prompt'])) {
            $prompt = $_POST['prompt'];
            $response = $this->askAI($prompt);
        }

        // Rendre la variable accessible à la vue
        $responseAI = $response;

        require __DIR__ . '/../../Views/front/ia.php';
    }

    private function askAI($prompt)
    {
        $payload = [
            "messages" => [
                ["role" => "user", "content" => $prompt]
            ],
            "model" => "llama-3.1-8b-instant",
            "temperature" => 1,
            "max_completion_tokens" => 512,
            "stream" => false
        ];

        $ch = curl_init("https://api.groq.com/openai/v1/chat/completions");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer " . $this->apiKey
            ],
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $result = curl_exec($ch);

        if ($result === false) {
            return "❌ Erreur CURL : " . curl_error($ch);
        }

        $json = json_decode($result, true);

        curl_close($ch);

        if (isset($json['error'])) {
            return "❌ Erreur API : " . $json['error']['message'];
        }

        return $json['choices'][0]['message']['content'] ?? "Erreur API 🚨";
    }
}
