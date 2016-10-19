<?php

use Illuminate\Foundation\Testing as testServices;
use Illuminate\Support\Facades\Auth;

abstract class TestCase extends testServices\TestCase
{

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @beforeClass
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        $this->baseUrl = $_ENV['MY_SERVER_URL'];

        return $app;
    }

    /**
     * Will be called before every test, in order to reset the database.
     * the DatabaseMigration treat cannot be used for this as the artisan command requires variables
     *
     * @before
     */
    public function setUp()
    {

        parent::setUp();

        // migrate the database. Used instead of the DatabaseMigration trait to be able to specify
        // a path for the migrate command.
        $this->artisan('migrate:refresh', [
            // TODO these still refer to the local database directory. should become the package's ones
//            '--path' => 'vendor/lorawan-team/delta_service/databases/migrations/',
//            '--path' => 'vendor/lorawan-team/delta_verification/databases/migrations/',
//            '--package' => 'lorawan-team/delta_service',
//            '--package' => 'lorawan-team/delta_verification',
            '--seed' => true,
        ]);

        Auth::loginUsingId(1);

        echo("- migrate -");
    }
}
