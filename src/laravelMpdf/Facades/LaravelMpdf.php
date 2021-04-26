<?php

namespace Asoltani\LaravelMpdf\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;
use Asoltani\LaravelMpdf\LaravelMpdf as Pdf;

/**
 * Class LaravelMpdf
 * @package Asoltani\LaravelMpdf\Facades
 *
 * @method Pdf loadHTML(string $html, ?array $config = [])
 * @method Pdf loadFile(string $file, ?array $config = [])
 * @method Pdf loadView(string $view, ?array $data = [], ?array $mergeData = [], ?array $config = [])
 * @method Pdf chunkLoadHTML(string $separator, string $html, ?array $config = [])
 * @method Pdf chunkLoadFile(string $separator, string $file, ?array $config = [])
 * @method Pdf chunkLoadView(string $separator, string $view, ?array $data = [], ?array $mergeData = [], ?array $config = [])
 */
class LaravelMpdf extends BaseFacade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { 
		return 'mpdf.container';
	}
}
