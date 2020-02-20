<?php
require('rb.php');
R::setup( 'mysql:host=localhost;dbname=orm', 'root', '' ); # real db
$soldier = R::dispense('soldier');
$mctype = R::load('mctype',1);
echo "<br> MC TYPE  mctype['name'] : ".$mctype['name'];

$soldier->name = "test1";
$soldier->mctype =$mctype;
$id = R::store($soldier);
echo "<br> insert id is ".$id;

$soldier1 = R::load('soldier',$id);
$mctype1= $soldier1->mctype;
echo "<br> soldier name is ".$soldier1->name;
echo "<br> MC TYPE final is : ".$mctype1->name;
echo "<br> MC TYPE final 2 : ".$soldier1->mctype->name;
echo "<br> MC TYPE final 3  : ".$soldier1['mctype']->name;
echo "<br> MC TYPE final 4  : ".$soldier1['mctype']['name'];
?>