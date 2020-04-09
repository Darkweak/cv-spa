<?php


namespace App\Controller;


use App\Entity\Article as ArticleEntity;
use App\Entity\Translation\ArticleTranslation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class Article
{
	private $entityManager;
	private $serializer;

	public function __construct(EntityManagerInterface $entityManager, NormalizerInterface $serializer)
	{
		$this->entityManager = $entityManager;
		$this->serializer = $serializer;
	}

	public function __invoke(string $slug)
	{
		$translation = $this->entityManager->getRepository(ArticleTranslation::class)->findOneBy([
			'slug' => \strtolower($slug)
		]);

		if (!$translation instanceof ArticleTranslation) {
			throw new NotFoundHttpException();
		}

		$article = $this->entityManager->getRepository(ArticleEntity::class)->find($translation->getTranslatable()->getId());

		if (!$article instanceof ArticleEntity) {
			throw new NotFoundHttpException();
		}

		return new JsonResponse($this->serializer->normalize($article, 'jsonld', ['groups' => ['article_item', 'translations']]));
	}
}
