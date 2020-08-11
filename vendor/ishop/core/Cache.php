<?php


namespace ishop;


class Cache
{
    use TSingletone;

    public function set($key,$data,$second = 3600){
        if($second){
            $content["data"] = $data;
            $content["time_end"] = time() + $second;
            $filePath = CACHE . "/".md5($key).".txt";
            if(file_put_contents($filePath, serialize($content))){
                return true;
            }
        }
        return false;
    }

    public function get($key){
        $filePath = CACHE . "/".md5($key).".txt";
        if(file_exists($filePath)){
            $content = file_get_contents($filePath);
            $content = unserialize($content);
            if(time() <= $content["time_end"]){
                return $content["data"];
            }
            unlink($filePath);
        }
        return false;
    }

    public function delete($key){
        $filePath = CACHE . "/".md5($key).".txt";
        if(file_exists($filePath)){
            unlink($filePath);
        }
    }



}