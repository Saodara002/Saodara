<?php

class Usuario{
    public int $id;
    public string $nome;
    public string $email;
    private string $senha;
    public string $tipo; // docente e aluno

    public function __construct(int $id, string $nome, string $email, string $tipo){
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->tipo = $tipo;
    }

    public function saudacao(): string{
        return "olá, {$this->nome}!";
    }

    public function tipo_formatado(): string{
        return "{$this->tipo}";
    }

    public function definirSenha(string $senha): void,{
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);   
    }

    public function verificarSenha(string $senha): bool{
        return password_verify($senha, $this->senha);
    }
}

class Professor extends Usuario{
    public array $materias_leciona = [];

    public function __construct(int $id, string $nome, string $email, array $materias_leciona){
       parent::__construct($id, $nome, $email, "professor");
       $this->materias_leciona = $materias_leciona;
    }
}


class Aluno extends Usuario{
    public int $xp_total = 0;

    public function __construct(int $id, string $nome, string $email, int $xp_total){
        parent::__construct($id, $nome, $email, 'aluno');
        $this->xp_total = $xp_total;
    }
}



?>
