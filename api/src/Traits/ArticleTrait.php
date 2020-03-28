<?php

namespace App\Traits;

use App\Entity\Article;

/**
 * @property Article $article
 */
trait ArticleTrait
{
	public function getArticle(): Article
	{
		return $this->article;
	}

	public function setArticle(Article $article): self
	{
		$this->article = $article;
		return $this;
	}
}
