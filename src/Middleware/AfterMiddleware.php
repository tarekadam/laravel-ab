<?php namespace Jenssegers\AB\Middleware;

use Jenssegers\AB\TesterServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Foundation\Application;
use Closure;

class AfterMiddleware {

    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $this->app['ab']->track($request);

        return $response;
    }

}
