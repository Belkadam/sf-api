<?php

declare(strict_types=1);

namespace App\Controller\Authenticated;

use App\Client\YtDlpClient;
use App\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/tube-flow', name: 'flow_tube_')]
class FlowTubeController extends AbstractApiController
{
    function __construct(private readonly YtDlpClient $ytDlpClient)
    {
    }

    /**
     * Get audio file from yt-dlp
     */
    #[Route('/audio-file/{videoId}', name: 'get_audio_file', methods: ['GET'])]
    public function getAudio(string $videoId): Response
    {
        $url = $this->ytDlpClient->getAudioUrl($videoId);

        return new JsonResponse($this->getJsonResponse($url, 'Audio url file'), Response::HTTP_OK);
    }
}
