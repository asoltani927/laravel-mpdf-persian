<?php

namespace ASoltani\LaravelMpdf;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use ASoltani\LaravelMpdf\LaravelMpdf as Pdf;

class LaravelMpdfWrapper 
{
    /**
     * @param array $config
     * @return LaravelMpdf
     */
    public function getPdf($config = [])
    {
        return new LaravelMpdf($config);
    }
    
	/**
	 * Load a HTML string
	 *
	 * @param string $html
	 * @return Pdf
	 */
	public function loadHTML($html, $config = [])
	{
	    $pdf = $this->getPdf($config);
	    $pdf->getMpdf()->WriteHTML($html);
	    
	    return $pdf;
	}

    /**
     * Chunk a HTML with given word and load string
     *
     * @param string $separator 
     * @param string $html
     * @return Pdf
     */
    public function chunkLoadHTML($separator, $html, $config = [])
    {
        $pdf = $this->getPdf($config);
        
        $chunks = explode($separator, $html);
        foreach($chunks as $chunk) {
            $pdf->getMpdf()->WriteHTML($chunk);
        }
        
        return $pdf;
    }

	/**
	 * Load a HTML file
	 *
	 * @param string $file
	 * @return Pdf
	 */
	public function loadFile($file, $config = [])
	{
	    return $this->loadHTML(File::get($file), $config);
	}

    /**
     * Chunk a HTML file with given word and load HTML
     *
     * @param string $separator
     * @param string $file
     * @return Pdf
     */
	public function chunkLoadFile($separator, $file, $config = [])
    {
        return $this->chunkLoadHTML($separator, File::get($file), $config);
    }

	/**
	 * Load a View and convert to HTML
	 *
	 * @param string $view
	 * @param array $data
	 * @param array $mergeData
	 * @return Pdf
	 */
	public function loadView($view, $data = [], $mergeData = [], $config = [])
	{
	    return $this->loadHTML(View::make($view, $data, $mergeData)->render(), $config);
	}

    /**
     * Chunk a View with given word and load HTML
     *
     * @param string $separator
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @return Pdf
     */
    public function chunkLoadView($separator, $view, $data = [], $mergeData = [], $config = [])
    {
        return $this->chunkLoadHTML($separator, View::make($view, $data, $mergeData)->render(), $config);
    }
}