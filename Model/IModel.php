<?php

interface IModel{
  public function findAll(); 
  public function find($id);
  public function search($data);
  public function save();
  public function delete($id);
}
