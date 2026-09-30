<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/m.php';

class Controlador{
    function validar_login (string $email, string $senha, array $usuarios): array{
        foreach ($usuarios as $usuario) {
            if (!$usuario instanceof Usuario) {
                continue;
            }

            if (strtolower($usuario->email) === strtolower($email) && $usuario->verificarSenha($senha)) {
                return [
                    'sucesso' => true,
                    'mensagem' => 'Login realizado com sucesso!',
                    'usuario' => $usuario,
                ];
            }
        }

        return [
            'sucesso' => false,
            'mensagem' => 'E-mail ou senha inválidos.',
            'usuario' => null,
        ];
    }

    function carregar_usuarios(): array{
        $professor = new Professor(1, 'pedroNerdJf@gmail.com.br', 'pedroNerdJf@gmail.com.br', ['PHP', 'HTML',]);
        $professor->definirSenha('professor123');

        $aluno = new Aluno(2, 'brenoPInto', 'brenop@gmail.com.br', 0);
        $aluno->definirSenha('aluno123');

        return [$professor, $aluno];
    }

    function dados_view(): array{
            $usuarios = $this->carregar_usuarios();
            $controlador = new Controlador();

            $tentativas = [
                ['label' => 'Professor - login correto', 'email' => $usuarios[0]->email, 'senha' => 'professor123'],
                ['label' => 'Aluno - login correto', 'email' => $usuarios[1]->email, 'senha' => 'aluno123'],
                ['label' => 'Aluno - senha incorreta', 'email' => $usuarios[1]->email, 'senha' => 'senhaerrada'],
                ['label' => 'Usuário inexistente', 'email' => 'usuarioinexistente@gmail.com', 'senha' => 'senha123']
            ];

            $resultados = [];
            foreach ($tentativas as $tentativa) {
                $resultado = $controlador->validar_login($tentativa['email'], $tentativa['senha'], $usuarios);
                $resultado['label'] = $tentativa['label'];
                $resultados[] = $resultado;
            }
            return [
                'usuarios' => $usuarios,
                'resultados' => $resultados
            ];
    }
}
?>
