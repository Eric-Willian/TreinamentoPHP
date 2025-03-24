<?php

abstract class ClassConexao{

    protected function conectaDB(){
        try{
          $Con=new mysqli("localhost","root","","treinamento_php");
          return $Con;
        }catch (Exception $Erro){
            return $Erro->getMessage();
        }
    }
}