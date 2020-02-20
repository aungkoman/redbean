<?php
require 'rb.php';
//R::setup(); # setup sqlite db
R::setup( 'mysql:host=localhost;dbname=orm', 'root', '' ); # real db
$post = R::dispense( 'post' ); # table / record
$post->title = 'My holiday';  # column 
$id = R::store( $post ); # return inserted id
$post = R::load( 'post', $id ); # get specific id post
echo $post->title; // as membership assess operator
echo $post['title']; // as array
R::trash( $post ); # delete record (bean)

# finding
$posts = R::find('post', ' title LIKE ?', [ 'holiday' ] ); # find method
$books = R::getAll('SELECT * FROM book WHERE price < ? ',[ 50 ] ); # raw query method

# relation 
$post->ownPhotoList[] = $photo1; # $photo1 and $photo2 are also bean :D type of 'photo'
$post->ownPhotoList[] = $photo2;
R::store( $post );
/*
        Here, $photo1 and $photo2 are also beans (but of type 'photo').
After storing the post, these photos will be associated with the blog post.
To associate a bean you simply add it to a list. The name of the list must match the name of the related bean type.
So photo beans go in:
$post->ownPhotoList

comments go in:
$post->ownCommentList

and notes go in:
$post->ownNoteList

See? It's that simple!
*/
$post = R::load( 'post', $id );
$firstPhoto = reset( $post->ownPhotoList ); # php native funciton reset : to get first array element

$threePhotos = $post->with( 'LIMIT 3' )->ownPhotoList; // with method can pass sql snip

R::freeze( TRUE ); # not to change db schema in production 
?>