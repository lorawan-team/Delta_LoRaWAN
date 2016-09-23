<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Dingo\Api\Http\Response;
use Closure;
use Illuminate\Support\Facades\Auth;
use Delta\DeltaVerification\Tokens\TokenRepositoryInterface as TokenRepository;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthToken
{
    /**
     * @var TokenRepositoryInterface
     */
    protected $token;

    /**
     * bind instances to class
     */
    public function __construct(TokenRepository $token)
    {
        $this->token = $token;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(
        Request $request,
        Closure $next
    ) {
        try {
            $decodedString = base64_decode(\JWTAuth::parseToken()->getToken()->get());

            if (is_null($decodedString)) {
                $this->error(400, 'No bearer token included');
            }

            $json = substr($decodedString, 0, strpos($decodedString, '}'));
            $token = json_decode($json . "}", true)['jti'];

            $accountId = $request->get('account_id');

            if ($request->route()->getName() === 'owner.index') {
                $this->authenticate($this->token->findUserByToken($token));
                return $next($request);
            }

            if (is_null($accountId)) {
                return $this->error(400, 'No account ID included with request');
            }

            // Token must not be revoked yet when checking
            if (!$this->token->verifyUserByTokenAndAccountId($token, $accountId)) {
                $this->authenticate($this->token->findUserByToken($token));
                return $next($request);
            }

            return $this->error(400, 'Invallid bearer token included or false account');
        } catch (TokenInvalidException $e) {
            return $this->error(400, 'Invallid token provided');
        } catch (\Exception $e) {
            return $this->error(400, 'Invallid token provided');
        }
    }

    protected function authenticate($user)
    {
        if (!\Auth::check()) {
            return \Auth::login($user);
        }
    }


    /**
     * Return an error response.
     *
     * @param  int     $statusCode
     * @param  string  $message
     * @return \Illuminate\Http\Reponse
     */
    protected function error($statusCode, $message)
    {
        $error = [
            'message' => $message,
            'status_code' => $statusCode,
        ];

        return (new Response($error))->setStatusCode($statusCode);
    }
}
