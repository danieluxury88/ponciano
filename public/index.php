<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(dirname(__DIR__) . '/templates');
$twig = new Environment($loader);

$icon = function (string $inner): string {
    return '<svg class="icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">' . $inner . '</svg>';
};

$icons = [
    'unidad' => $icon('<circle cx="9.5" cy="12" r="6" fill="currentColor" fill-opacity=".5"/><circle cx="14.5" cy="12" r="6" fill="currentColor" fill-opacity=".85"/>'),
    'amor' => $icon('<path d="M12 21s-7.5-4.6-9.8-9.1C.6 8.7 1.8 5 5.3 5c2 0 3.6 1.2 4.7 2.9C11.1 6.2 12.7 5 14.7 5c3.5 0 4.7 3.7 3.1 6.9C15.5 16.4 12 21 12 21z" fill="currentColor"/>'),
    'dones' => $icon('<path d="M12 2C12 7.5 7.5 12 2 12C7.5 12 12 16.5 12 22C12 16.5 16.5 12 22 12C16.5 12 12 7.5 12 2Z" fill="currentColor"/>'),
    'eucaristia' => $icon('<path d="M7 3H17L16.1 8.2C15.7 10.6 14 12.3 12 12.3C10 12.3 8.3 10.6 7.9 8.2L7 3Z M11.3 12.3H12.7L12.5 18.5H11.5Z M8.7 20.2H15.3L14.8 21.7H9.2Z" fill="currentColor"/>'),
    'conversion' => $icon('<path d="M12 21C6.5 19.3 4.3 13.6 6 8C9.8 9 13 6.3 17.5 6.2C18 12.7 16.3 19.2 12 21Z" fill="currentColor"/>'),
    'resurreccion' => $icon('<path d="M10.3 3H13.7V9.3H20V12.7H13.7V21H10.3V12.7H4V9.3H10.3Z" fill="currentColor"/>'),
];

Flight::route('/', function () use ($twig) {
    echo $twig->render('landing.html.twig', [
        'title' => 'Grupo de Biblia · Cartas a los Corintios',
        'nav' => 'inicio',
        'letters' => [
            [
                'available' => true,
                'url' => '/1-corintios',
                'numeral' => 'I',
                'eyebrow' => 'Primera Carta',
                'title' => 'Primera Carta a los Corintios',
                'description' => 'Unidad, amor, dones y esperanza en la comunidad de Corinto.',
            ],
            [
                'available' => false,
                'url' => '/2-corintios',
                'numeral' => 'II',
                'eyebrow' => 'Segunda Carta',
                'title' => 'Segunda Carta a los Corintios',
                'description' => 'Un nuevo recorrido por la carta de Pablo a los Corintios.',
            ],
        ],
    ]);
});

Flight::route('/1-corintios', function () use ($twig, $icons) {
    echo $twig->render('1-corintios.html.twig', [
        'title' => 'Todo lo que hagan, háganlo con amor',
        'verse' => '1 Corintios 16,14',
        'nav' => '1-corintios',
        'topics' => [
            ['icon' => $icons['unidad'], 'title' => 'Unidad', 'text' => 'Somos muchos miembros, pero un solo cuerpo en Cristo.'],
            ['icon' => $icons['amor'], 'title' => 'Amor', 'text' => 'Sin amor, incluso los dones más grandes pierden su sentido.'],
            ['icon' => $icons['dones'], 'title' => 'Dones y carismas', 'text' => 'Lo recibido de Dios no es para destacar, sino para servir y edificar a los demás.'],
            ['icon' => $icons['eucaristia'], 'title' => 'Eucaristía', 'text' => 'Reunirnos alrededor de la mesa del Señor también nos llama a reconocernos como hermanos.'],
            ['icon' => $icons['conversion'], 'title' => 'Conversión', 'text' => 'La vida cristiana pide revisar nuestras decisiones y orientar nuevamente el corazón hacia Dios.'],
            ['icon' => $icons['resurreccion'], 'title' => 'Resurrección', 'text' => 'Nuestra esperanza no termina en la muerte: Cristo ha resucitado y nuestra vida está llamada a la plenitud en Él.'],
        ],
        'messages' => [
            [
                'text' => 'Que no haya divisiones entre ustedes.',
                'ref' => '1 Corintios 1,10',
            ],
            [
                'text' => 'La sabiduría de este mundo es necedad ante Dios.',
                'ref' => '1 Corintios 3,19',
            ],
            [
                'text' => 'Ustedes son templo de Dios y el Espíritu de Dios habita en ustedes.',
                'ref' => '1 Corintios 3,16',
            ],
            [
                'text' => 'Hagan todo para gloria de Dios.',
                'ref' => '1 Corintios 10,31',
            ],
            [
                'text' => 'Que nadie busque su propio interés, sino el bien de los demás.',
                'ref' => '1 Corintios 10,24',
            ],
            [
                'text' => 'Cada vez que comen este pan y beben esta copa, anuncian la muerte del Señor.',
                'ref' => '1 Corintios 11,26',
            ],
            [
                'text' => 'Hay diversidad de dones, pero el Espíritu es el mismo.',
                'ref' => '1 Corintios 12,4',
            ],
            [
                'text' => 'A cada uno se le da la manifestación del Espíritu para el bien común.',
                'ref' => '1 Corintios 12,7',
            ],
            [
                'text' => 'Somos muchos miembros, pero un solo cuerpo.',
                'ref' => '1 Corintios 12,20',
            ],
            [
                'text' => 'El amor es paciente, es bondadoso.',
                'ref' => '1 Corintios 13,4',
            ],
            [
                'text' => 'El amor nunca pasa.',
                'ref' => '1 Corintios 13,8',
            ],
            [
                'text' => 'Permanecen la fe, la esperanza y el amor; pero el mayor de ellos es el amor.',
                'ref' => '1 Corintios 13,13',
            ],
            [
                'text' => 'Busquen el amor.',
                'ref' => '1 Corintios 14,1',
            ],
            [
                'text' => 'Cristo ha resucitado de entre los muertos.',
                'ref' => '1 Corintios 15,20',
            ],
            [
                'text' => 'Gracias sean dadas a Dios, que nos da la victoria por nuestro Señor Jesucristo.',
                'ref' => '1 Corintios 15,57',
            ],
            [
                'text' => 'Manténganse firmes y progresen siempre en la obra del Señor.',
                'ref' => '1 Corintios 15,58',
            ],
            [
                'text' => 'Manténganse firmes en la fe; sean valientes y fuertes.',
                'ref' => '1 Corintios 16,13',
            ],
            [
                'text' => 'Todo lo que hagan, háganlo con amor.',
                'ref' => '1 Corintios 16,14',
            ],
        ],
    ]);
});

Flight::route('/2-corintios', function () use ($twig) {
    echo $twig->render('coming-soon.html.twig', [
        'title' => 'Segunda Carta a los Corintios',
        'eyebrow' => 'Grupo de Biblia · Segunda Carta a los Corintios',
        'message' => 'Estamos preparando este recorrido. Muy pronto podrás vivirlo aquí.',
        'nav' => '2-corintios',
    ]);
});

Flight::start();