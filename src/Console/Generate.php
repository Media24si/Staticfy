<?php

namespace Media24si\Staticfy\Console;

use Illuminate\Console\Command;

class Generate extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'staticfy:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate static pages';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $routes = \Route::getRoutes()->getRoutes();

        foreach ($routes as $route) {
            $outputFile = config('staticfy.output_path') . '/' . ($route->getUri() == '/' ? 'index.html' : $route->getUri());
            
            $req = \Illuminate\Http\Request::create($route->getUri());
            $route->bind($req);

            $response = $route->run( $req );

            if ( is_a($response, 'Illuminate\View\View') ) {
                $dir = dirname($outputFile);
                if (! is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                file_put_contents($outputFile, $response->render());
                $this->info( $outputFile );
            }
        }
    }
}
