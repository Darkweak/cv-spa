<?php


namespace App\Migrations;


use Ramsey\Uuid\Uuid;

class MigrationHelper
{
	private $id;
	private $tagIds;

	public function __construct(string $id = null, array $tagIds = null)
	{
		$this->id = $id;
		$this->tagIds = $tagIds;
	}

    /**
     * @param string[][] $values
     * @return string
     * @throws \Exception
     */
    public function insert(string $table, array $fields, array $values, bool $withoutId = false): string
    {
    	$idField = $withoutId ? '' : 'id,';
        $fields = \join(', ', $fields);
        $rq = "INSERT INTO $table ($idField $fields) VALUES ";

        foreach ($values as $k => $value) {
        	if ($withoutId) {
				$id = '';
			} else {
				$id = "'".(Uuid::uuid4())->serialize()."', ";
			}

            $rq .= \sprintf(
            	'(%s)',
				$withoutId ?
					\join(',', $value) :
					($id. \join(',', $value))
			);
            if (isset($values[(int)$k + 1])) {
                $rq .= ", ";
            }
        }

        return $rq;
    }

	public function getTags($positions): array
	{
		return \array_map(
			function($tag) { return ["'$this->id'", "'$tag'"]; },
			\array_map(
				function($position) { return $this->tagIds[$position]['id']; },
				$positions
			)
		);
	}
}
