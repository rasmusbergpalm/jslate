<?php

interface SourceInterface {

    /**
     * @param $properties
     * @return array
     */
    public function query($properties);
}