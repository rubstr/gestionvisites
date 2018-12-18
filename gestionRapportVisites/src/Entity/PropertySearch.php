<?php
namespace App\Entity;

class PropertySearch{

    /**
     * date|null
     */
private $dateSearch;
private $search;
    


/**
 * Get date|null
 */ 
public function getDateSearch()
{
return $this->dateSearch;
}

/**
 * Set date|null
 *
 * @return  self
 */ 
public function setDateSearch($dateSearch)
{
$this->dateSearch = $dateSearch;

return $this;
}

/**
 * Get the value of search
 */ 
public function getSearch()
{
return $this->search;
}

/**
 * Set the value of search
 *
 * @return  self
 */ 
public function setSearch($search)
{
$this->search = $search;

return $this;
}
}






?>