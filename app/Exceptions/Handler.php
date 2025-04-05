<?php

namespace App\Exceptions;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Page;
use App\Models\Type;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {

            $segments = $request->segments();
            $language = $segments[0];
            $country = $segments[1];
            $city = $segments[2];

            $segments = array_splice($segments, 3);
            $path = implode('/', $segments);
            $identifier = $segments[0];

            \URL::defaults([
                'language' => $language,
                'country' => $country,
                'city' => $city,
            ]);

            if ($path == "d/cars")
                return redirect()->route('website.cars.with-drivers');

            if ($path == "yacht")
                return redirect()->route('website.yachts.index');

            if ($path == "blog")
                return redirect()->route('website.blogs.index');

            switch ($identifier) {
                case 't':
                    $type = Type::findOrFail($segments[1]);
                    return redirect()->route('website.cars.types.show', ['type' => $type]);

                case 'b':
                    $brand = Brand::findOrFail($segments[1]);
                    return redirect()->route('website.cars.brands.show', ['brand' => $brand]);

                case 'p':
                    $page = Page::findOrFail($segments[1]);
                    return redirect()->route('website.pages.show', ['page' => $page]);

                case 'blog-details':
                    $blog = Blog::findOrFail($segments[1]);
                    return redirect()->route('website.blogs.show', ['blog' => $blog]);

                default:
                    $car = Car::findOrFail($segments[1]);
                    return redirect()->route("website.cars.show", ['car' => $car]);
            }
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
