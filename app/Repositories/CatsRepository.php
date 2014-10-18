<?php namespace RestedCats\Repositories;

class CatsRepository extends AbstractRepository
{
    protected $table = "cats";

    /**
     * Find a cat by name
     *
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        $query = $this->fpdo->from($this->table)->where('name', $name);
        return $this->toArray($query);
    }
}
