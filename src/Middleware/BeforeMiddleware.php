<?php namespace Jenssegers\AB\Middleware;

use Jenssegers\AB\TesterServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Foundation\Application;
use Closure;

class BeforeMiddleware implements Middleware {

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
        $this->app['ab']->track($request);
        return $next($request);
    }

}
