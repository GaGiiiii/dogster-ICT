<?php

function getCategories(){
    return executeQuery("SELECT * FROM categories");
}