<?php

    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

    class CheckApiKeyMiddleware {
        public function __invoke(Request $request, RequestHandler $handler): Response {
            $apiKeyEnv = getenv('API_KEY');  // API Key stockée dans l'environnement
            $apiKeyHeader = $request->getHeaderLine('X-API-KEY');  // API Key envoyée dans le header

            // Vérifier la clé API
            if ($apiKeyEnv === $apiKeyHeader) {
                // Passer à l'étape suivante (le prochain middleware ou la route)
                return $handler->handle($request);
            } else {
                // Si la clé est incorrecte, retourner une erreur
                $response = $handler->getResponseFactory()->createResponse();
                $response->getBody()->write('Unauthorized');

                return $response->withStatus(401);
            }
        }
    }
?>