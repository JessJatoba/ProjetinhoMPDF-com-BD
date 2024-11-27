<?php
require 'vendor/autoload.php';

// Definindo produtos
$produtos = [
    [
        'nome' => 'Pão',
        'categoria' => 'Padaria',
        'preco' => 29.99,
        'descricao' => 'Pão Doce.'
    ],
    [
        'nome' => 'Feijão',
        'categoria' => 'Alimento',
        'preco' => 49.99,
        'descricao' => 'Feijão Preto.'
    ],
    [
        'nome' => 'Refrigerante',
        'categoria' => 'Bebida',
        'preco' => 19.99,
        'descricao' => 'Refrigerante Laranja.'
    ],
    [
        'nome' => 'Creme Dental',
        'categoria' => 'Higiene',
        'preco' => 99.99,
        'descricao' => 'Creme Dental Fluor.'
    ],
];

$mpdf = new \Mpdf\Mpdf();

$css = file_get_contents('estilos.css');
$mpdf->WriteHTML($css, 1); // 1 para aplicar o CSS

$mpdf->WriteHTML('<h1>Relatório de Produtos</h1>');

$dataGeracao = date('d/m/Y H:i:s');
$mpdf->WriteHTML('<h2>Data de Geração: ' . $dataGeracao . '</h2>');

$mpdf->WriteHTML('<table>');
$mpdf->WriteHTML('<tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                  </tr>');

foreach ($produtos as $produto) {
    $mpdf->WriteHTML('<tr>
                        <td>' . $produto['nome'] . '</td>
                        <td>' . $produto['categoria'] . '</td>
                        <td>R$ ' . number_format($produto['preco'], 2, ',', '.') . '</td>
                        <td>' . $produto['descricao'] . '</td>
                      </tr>');
}

$mpdf->WriteHTML('</table>');

$mpdf->Output('relatorio_produtos.pdf', 'D'); 
?>