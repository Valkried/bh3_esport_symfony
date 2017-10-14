<?php

namespace BH3Bundle\Services;

class UploadImg
{
    public function upload($entity, $dir)
    {
        $picture = $entity->getPicture();

        $pictureName = md5(uniqid()).'.'.$picture->guessExtension();

        $picture->move('../web/img/'.$dir, $pictureName);

        $entity->setPicture($pictureName);

        return $this;
    }
}