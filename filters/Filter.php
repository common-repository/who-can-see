<?php


abstract class Filter
{
    protected $affected = [];

    /**
     * Select the roles that will be used
     *
     * @param $affected
     * @return $this
     */
    public function select($affected)
    {
        $this->affected = $affected;
        return $this;
    }
}