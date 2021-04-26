<?php

namespace ASoltani\LaravelMpdf;

use Mpdf\Mpdf;

class LaravelMpdf extends MpdfConfig{

    protected $mpd;

    public function __construct($config)
    {
		parent::__constract($config);
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $tempDir = $defaultConfig['tempDir'];
        
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $this->mpdf = new Mpdf([
			'mode' => $this->getConfig('mode'),
			'format' => $this->getConfig('format'),
			'orientation' => $this->getConfig('orientation'),
			'default_font_size' => $this->getConfig('default_font_size'),
			'default_font' => $this->getConfig('default_font'),
			'margin_left' => $this->getConfig('margin_left'),
			'margin_right' => $this->getConfig('margin_right'),
			'margin_top' => $this->getConfig('margin_top'),
			'margin_bottom' => $this->getConfig('margin_bottom'),
			'margin_header' => $this->getConfig('margin_header'),
			'margin_footer' => $this->getConfig('margin_footer'),
			'fontDir' => array_merge($fontDirs, [
				$this->getConfig('custom_font_dir')
			]),
			'fontdata' => array_merge($fontData, $this->getConfig('custom_font_data')),
			'default_font' => $this->getConfig('default_font'), 
			'autoScriptToLang' => $this->getConfig('auto_language_detection'), 
			'autoLangToFont' => $this->getConfig('auto_language_detection'),
			'tempDir' => ($this->getConfig('temp_dir')) ?: $tempDir,
		]);

		$this->mpdf->SetTitle         ( $this->getConfig('title') );
		$this->mpdf->SetAuthor        ( $this->getConfig('author') );
		$this->mpdf->SetWatermarkText ( $this->getConfig('watermark') );
		$this->mpdf->SetDisplayMode   ( $this->getConfig('display_mode') );
        
        $this->mpdf->PDFA = $this->getConfig('pdfa') ?? false;
        $this->mpdf->PDFAauto = $this->getConfig('pdfaauto') ?? false;

		$this->mpdf->showWatermarkText  = $this->getConfig('show_watermark');
		$this->mpdf->watermark_font     = $this->getConfig('watermark_font');
		$this->mpdf->watermarkTextAlpha = $this->getConfig('watermark_text_alpha');

        $this->mpdf->SetDirectionality($this->getConfig('direction'));
    }

    /**
	 * Get instance mpdf
	 * @return static
	 */
	public function getMpdf()
	{
		return $this->mpdf;
	}


	/**
	 * Output the PDF as a string.
	 *
	 * @return string The rendered PDF as string
	 */
	public function output()
	{
		return $this->mpdf->Output('', 'S');
	}

	/**
	 * Save the PDF to a file
	 *
	 * @param $filename
	 * @return static
	 */
	public function save($filename)
	{
		return $this->mpdf->Output($filename, 'F');
	}

	/**
	 * Make the PDF downloadable by the user
	 *
	 * @param string $filename
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function download($filename = 'document.pdf')
	{
		return $this->mpdf->Output($filename, 'D');
	}

	/**
	 * Return a response with the PDF to show in the browser
	 *
	 * @param string $filename
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function stream($filename = 'document.pdf')
	{
		return $this->mpdf->Output($filename, 'I');
	}
    
}