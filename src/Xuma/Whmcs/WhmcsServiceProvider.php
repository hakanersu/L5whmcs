<?php
namespace Xuma\Whmcs;

use Illuminate\Support\ServiceProvider;

class WhmcsServiceProvider extends ServiceProvider
{
	/**
	 * Indicates of loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerServices();

		$this->registerResources();
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['whmcs'];
	}

	/**
	 * Register the package services.
	 *
	 * @return void
	 */
	protected function registerServices()
	{
		
		$this->app->bindShared('whmcs', function($app) {
			return $this->app->make('Xuma\Whmcs\WhmcsHandler');
		});
	}

	/**
	 * Register the package resources.
	 *
	 * @return void
	 */
	protected function registerResources()
	{
		
	}
}