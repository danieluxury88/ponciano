<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(dirname(__DIR__) . '/templates');
$twig = new Environment($loader);

Flight::route('/', function () use ($twig) {
    echo $twig->render('landing.html.twig', [
        'title' => 'Grupo de Biblia · Cartas a los Corintios',
        'letters' => [
            [
                'available' => true,
                'url' => '/1-corintios',
                'eyebrow' => 'Primera Carta',
                'title' => 'Primera Carta a los Corintios',
                'description' => 'Unidad, amor, dones y esperanza en la comunidad de Corinto.',
            ],
            [
                'available' => false,
                'url' => '/2-corintios',
                'eyebrow' => 'Segunda Carta',
                'title' => 'Segunda Carta a los Corintios',
                'description' => 'Un nuevo recorrido por la carta de Pablo a los Corintios.',
            ],
        ],
    ]);
});

Flight::route('/1-corintios', function () use ($twig) {
    echo $twig->render('1-corintios.html.twig', [
        'title' => 'Todo lo que hagan, háganlo con amor',
        'verse' => '1 Corintios 16,14',
        'topics' => [
            ['icon' => '🕊️', 'title' => 'Unidad', 'text' => 'Somos muchos miembros, pero un solo cuerpo en Cristo.'],
            ['icon' => '❤️', 'title' => 'Amor', 'text' => 'Sin amor, incluso los dones más grandes pierden su sentido.'],
            ['icon' => '✨', 'title' => 'Dones y carismas', 'text' => 'Lo recibido de Dios no es para destacar, sino para servir y edificar a los demás.'],
            ['icon' => '🍞', 'title' => 'Eucaristía', 'text' => 'Reunirnos alrededor de la mesa del Señor también nos llama a reconocernos como hermanos.'],
            ['icon' => '🌱', 'title' => 'Conversión', 'text' => 'La vida cristiana pide revisar nuestras decisiones y orientar nuevamente el corazón hacia Dios.'],
            ['icon' => '✝️', 'title' => 'Resurrección', 'text' => 'Nuestra esperanza no termina en la muerte: Cristo ha resucitado y nuestra vida está llamada a la plenitud en Él.'],
        ],
        'messages' => [
            'El amor nunca pasa.',
            'Tus dones son también un regalo para los demás.',
            'Somos muchos miembros, pero un solo cuerpo.',
            'Busca no solo tu propio bien, sino también el bien del otro.',
            'Mantente firme y crece siempre en la obra del Señor.',
            'Cristo ha resucitado: nuestra esperanza está viva.',
            'Que todo lo que hagas nazca del amor.',
        ],
    ]);
});

Flight::route('/2-corintios', function () use ($twig) {
    echo $twig->render('coming-soon.html.twig', [
        'title' => 'Segunda Carta a los Corintios',
        'eyebrow' => 'Grupo de Biblia · Segunda Carta a los Corintios',
        'message' => 'Estamos preparando este recorrido. Muy pronto podrás vivirlo aquí.',
    ]);
});

Flight::start();