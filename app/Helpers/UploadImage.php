<?php

/**
 * UploadImage helper
 * 
 * @param $request
 * 
 */

function uploadImage($image) {

    $imageName = time() . '.' . $image->extension();        // on donne un nom à l'image : timestamp en temps unix + extension

    $image->move(public_path('images'), $imageName);        // on déplacel'image dans public/images

    return $imageName;                                      // on retourne le nom de l'image
}