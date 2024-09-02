<?php

class Product {

    private $id;
    private $name;
    private $price;
    private $description;
    private $image;

    public function __construct($id, $name, $price, $description, $image){
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function getPrice(){
        return $this->price;
    }

    public function setImage($image){
        $this->image = $image;
    }

    public function getImage(){
        return $this->image;
    }

    public function ReturnAsProductArray(){
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'price' => $this->price
        );
    }
}
