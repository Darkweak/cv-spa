<?php

namespace App\AbstractClasses;

use Symfony\Component\HttpFoundation\Response;

class PDF
{
	private $pdf;

	public function __construct()
	{
		$this->pdf = new \TCPDF();
		$this->pdf->setPrintHeader(false);
		$this->pdf->setPrintFooter(false);
		$this->pdf->SetAuthor('Sylvain COMBRAQUE');
		$this->pdf->SetTitle('Sylvain COMBRAQUE - cv');
		$this->pdf->SetSubject('Sylvain COMBRAQUE - cv');
		$this->pdf->AddPage();
	}

	public function setContent(string $content): self
	{
		$this->pdf->writeHTML($content);
		return $this;
	}

	public function show(): Response
	{
		return new Response($this->pdf->Output("Sylvain COMBRAQUE - cv.pdf"));
	}

}
