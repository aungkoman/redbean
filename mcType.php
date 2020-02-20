<?php
require 'rb.php';
//R::setup(); # setup sqlite db
R::setup( 'mysql:host=localhost;dbname=orm', 'root', '' ); # real db
$mctype = R::dispense( 'mctype' ); # redbean instance , I mean record prototype
$name = isset($_GET['name']) ? $_GET['name'] : null;
if($name == null){
        showMcType(0);
        return;
}
$mctype->name = $name;
try{
        # check duplicate
        $id = R::store($mctype);
        echo "id is ".$id."<br>";
        showMcType(0);
        return;
}
catch(Exception $exp){
        # can't insert
        echo "error in inserting <br>";
}

function showMcType($id){
        $mctypes = R::getAll('SELECT * FROM mctype WHERE id > ? LIMIT ? ',[$id,10]);
        echo "\n post length ".count($mctypes)."<br>";
        for($i = 0 ; $i<count($mctypes); $i++){
                echo $mctypes[$i]['name']."<br>";
        }
}

?>