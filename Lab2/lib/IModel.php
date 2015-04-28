<?php

interface IModel {
    //return to Empty state
    public function reset();
    
    //set parameter
    public function map(array $values);
}
