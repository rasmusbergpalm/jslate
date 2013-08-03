<?php

interface SourceInterface {

    /**
     * @param $query
     * @return array
     */
    public function query($query);
}