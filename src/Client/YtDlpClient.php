<?php

namespace App\Client;

use Exception;

class YtDlpClient extends AbstractClient
{
    CONST YT_DLP_BASE_URL = 'http://yt_dlp:8000';

    /**
     * Get audio file from yt-dlp
     */
    public function getAudioUrl(string $videoId): string
    {
        $response = $this->client->request('GET', self::YT_DLP_BASE_URL.'/download', [
            'query' => ['videoId' => $videoId]
        ]);
        if ($response->getStatusCode() !== 200) {
            throw new Exception('Failed to retrieve audio URL from yt-dlp');
        }
        $data = $response->toArray();

        return $data['path'] ?? throw new Exception('No url found in response');
    }
}