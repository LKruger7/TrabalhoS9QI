<?php

class Produto {
    private $marca;
    private $data_hora;
    private $quantidade;
    private $preco;

    public function __construct(
        $marca = "Genérica",
        $data_hora = 1,
        $quantidade = 1,
        $preco = 1
    )
    {
        $this->marca = $marca;
        $this->data_hora = $data_hora;
        $this->quantidade = $quantidade;
        $this->preco = $preco;
    }
    public function getMarca()
    {
        return $this->marca;
    }
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public function getData_hora()
    {
        return $this->data_hora;
    }
    public function setData_hora($data_hora)
    {
        $this->data_hora = $data_hora;
    }
    public function getQuantidade()
    {
        return $this->quantidade;
    }
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    public function __tostring(){
        return "<hr>
                <ul>
                <li>MARCA: {$this->marca}</li> 
                <li>DATA/HORA: {$this->data_hora}</li> 
                <li>QUANTIDADE: {$this->quantidade}</li> 
                <li>PREÇO: {$this->preco}</li> 
                </ul>";
    }
}