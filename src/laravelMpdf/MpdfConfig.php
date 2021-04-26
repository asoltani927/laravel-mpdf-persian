<?php

namespace asoltani927\LaravelMpdf;

use Illuminate\Support\Facades\Config;

abstract class MpdfConfig{

	protected array $config;

	function __constract(array $config = [])
	{
		$this->config = $config;
	}

    public function getConfig($key) {
		if (isset($this->config[$key])) {
			return $this->config[$key];
		} else {
			return Config::get('pdf.' . $key);
		}
	}
}