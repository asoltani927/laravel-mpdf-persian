<?php
namespace Asoltani\LaravelMpdf;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class LaravelMpdfServiceProvider extends BaseServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__ . '/../config/mpdf.php', 'mpdf'
		);

		$this->app->bind('mpdf.container', function($app) {
			return new LaravelMpdfContainer();
		});
	}

}