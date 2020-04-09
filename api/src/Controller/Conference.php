<?php


namespace App\Controller;


use App\Entity\Conference as ConferenceEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class Conference
{
	private $entityManager;
	private $serializer;

	public function __construct(EntityManagerInterface $entityManager, NormalizerInterface $serializer)
	{
		$this->entityManager = $entityManager;
		$this->serializer = $serializer;
	}

	public function __invoke(string $city, string $date)
	{
		$conference = $this->entityManager->getRepository(ConferenceEntity::class)->findOneBy([
			'city' => \ucfirst(\strtolower($city)),
			'date' => new \DateTime($date)
		]);

		if (!$conference instanceof ConferenceEntity) {
			throw new NotFoundHttpException();
		}

		return new JsonResponse($this->serializer->normalize($conference, 'jsonld', ['groups' => 'conference_item']));
	}
}
