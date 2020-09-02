<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Exception;
use DomainException;
use Firebase\JWT\JWT;
use App\Helpers\Response;
use UnexpectedValueException;
use App\Helpers\HttpStatusCodes;
use Firebase\JWT\ExpiredException;

class JwtMiddleware 
{
    use Response;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        if(!$token) {
            // Unauthorized response if token not there
            return $this->tokenError('Token not provided', HttpStatusCodes::UNAUTHORIZED);
        }

        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        }

        catch(ExpiredException $e) {
            return $this->tokenError('Expired Token', HttpStatusCodes::NOT_FOUND);
        }

        catch(UnexpectedValueException $e) {
            return $this->tokenError('Wrong Number of Segments in Token', HttpStatusCodes::NOT_FOUND);
        }

        catch(DomainException $e) {
            return $this->tokenError('Malformed Token', HttpStatusCodes::NOT_FOUND);   
        }
        
        catch(Exception $e) {
            return $this->tokenError('Error occured while decoding token', HttpStatusCodes::NOT_FOUND);
        }

        $user = User::find($credentials->sub);
        // Now let's put the user in the request class so that you can grab it from there
        $request->auth = $user;
        //dd($user->);
        return $next($request);
    }
}
