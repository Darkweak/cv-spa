<?php


namespace App\Controller;


use App\AbstractClasses\PDF;
use App\Entity\Diploma;
use App\Entity\Job;
use App\Entity\Site;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Environment;

class CV
{
	private $entityManager;
	private $environment;

	public function __construct(EntityManagerInterface $entityManager, Environment $environment)
	{
		$this->entityManager = $entityManager;
		$this->environment = $environment;
	}

	public function __invoke()
	{
		return (new PDF())
			->setContent(
				$this->environment->render(
					"cv.html.twig",
					[
						'jobs' => $this->entityManager->getRepository(Job::class)->findAll(),
						'diplomas' => $this->entityManager->getRepository(Diploma::class)->findAll(),
						'creations' => $this->entityManager->getRepository(Site::class)->findAll(),
					]
				)
			)
			->show();
	}
}
