<?php
require_once ('dbconnect.php');

class Tags extends Database{
    public function resultset()
    {
        $posts= parent::resultset();

        if (is_array($posts) && count($posts)){
            foreach($posts as &$post){
                $tags=[];

                $sql = 'SELECT t.name FROM post_tags pt LEFT JOIN tags t ON pt.tagid = t.id WHERE pt.postid = :id';

                parent::query($sql);
                parent::bind(':id', $post['id']);
                $postTags = parent::resultset();

                foreach($postTags as $ptag){
                    array_push($tags, $ptag['name']);
                }

                $post['tags'] = implode(', ', $tags);
            }

            return $posts;
        }

        else{
            return [];
        }
    }
}