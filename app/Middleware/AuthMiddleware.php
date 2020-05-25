<?php declare(strict_types=1);

namespace Mosyle\Middleware;

use Carbon\Carbon;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\RedirectResponse;

class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {

        $headers = $request->getHeaders();

        if (empty($headers['token'])) {
            $response = new Response;
            $response->getBody()->write(json_encode([
                'status' => 302,
                'message' => 'Não existe token!'
            ]));
            return $response;
        }

        $token = explode('.', $headers['token'][0]);

        $dataCriacaoToken = Carbon::createFromFormat('Y-m-d H:i:s', base64_decode($token[2]));

        if (
            $dataCriacaoToken->diffInDays(Carbon::now()) >= 1
        ) {
            $response = new Response;
            $response->getBody()->write(json_encode([
                'status' => 302,
                'message' => 'Você não está autenticado!'
            ]));

            return $response;
        }

        return $handler->handle($request);
    }
}