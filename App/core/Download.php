<?php

namespace Core;

class Download
{
    public function addToMedia(array $file){
        try {
            return $this->upload('media',$file['name'],$file['tmp_name']);
        }catch (\Exception $e){
            throw new \Exception("Il existe deja un photo de profile avec ce nom");
        }
   }
   private function upload($directory,$file,$source){
        $path=str_replace(' ','','/Uploads/'.$directory.'/'.$file);
        $root=str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).$path;
        if(!file_exists($root)){
            move_uploaded_file($source,$root);
            return $path;
        }else{
            throw new \Exception("Ce fichier a ete deja existe ");
        }
   }
   public function addToAnnonce(array $file){
       try {
           return $this->upload('annonce',$file['name'],$file['tmp_name']);
       }catch (\Exception $e){
           throw $e;
       }
   }
   public function addToRapport(array $file){
        try{
            return $this->upload('rapport',$file['name'],$file['tmp_name']);
        }catch (\Exception $e){
            throw $e;
        }
   }
   public function addToCours(array $file)
   {
       try{
           return $this->upload('cours',$file['name'],$file['tmp_name']);
       }catch (\Exception $e){
           throw $e;
       }
   }
   public function ModifyMedia(array $file,string $old_path){
        if ($old_path=='/Public/static/Images/us2.png'){
            try{
                return $this->upload('media',$file['name'],$file['tmp_name']);
            }catch (\Exception $e){
                throw new \Exception("Il existe deja un photo de profile avec ce nom");
            }
        }else{
            try {
                $root=str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).$old_path;
                if(file_exists($root)){
                    unlink($root);
                }
                return $this->upload('media',$file['name'],$file['tmp_name']);
            }catch(\Exception $e){
                throw new \Exception("Il existe deja un photo de profile avec ce nom");
            }
        }
        }
   }
