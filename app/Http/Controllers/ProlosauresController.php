<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProlosauresController extends Controller
{
    const min_largeur = 1;
    const max_largeur = 100000;
    const min_sommet = 0;
    const max_sommet = 100000;
    private $largeur;
    private $terrain;
    private $start_time;

    public function __construct(){
        $this->start_time = microtime(true);
        $this->largeur = 10;
        $this->terrain = "30 27 17 42 29 12 14 41 42 42";
    }

    public function index(Request $request){
        $this->checkWidth($this->largeur);
        $this->checkHeight($this->terrain);

        // Calcul de la superficie protégée
        $this->getSafezone($this->largeur, $this->terrain);

        // End timer
        $execution_time = microtime(true) - $this->start_time;
        echo "<br> Temps d'exécution = " .number_format($execution_time, 6). " secondes.<br>";
        echo "La mémoire utilisée = " . $this->convertToMemory(memory_get_usage()) . "<br>";
    }

    private function checkWidth($largeur)
    {
        if (!is_numeric($largeur)) {
            echo('Il ne faut pas mettre une valeur non numérique.');
            exit();
        }

        if ($largeur < self::min_largeur) {
            echo('La largeur ne peut pas être inférieure à : ' . self::min_largeur);
            exit();
        }

        if ($largeur > self::max_largeur) {
            echo('La largeur ne peut pas être supérieure à : ' . self::max_largeur);
            exit();
        }

        return $largeur;
    }

    private function checkHeight($terrain)
    {
        $altitudes = explode(" ", $terrain);

        foreach ($altitudes as $altitude) {
            if (!is_numeric($altitude)) {
                echo('Il ne faut pas mettre une valeur non numérique.');
                exit();
            }

            if ($altitude < self::min_sommet) {
                echo('Le sommet ne peut pas être inférieur à : ' . self::min_sommet);
                exit();
            }

            if ($altitude > self::max_sommet) {
                echo('Le sommet ne peut pas être supérieur à : ' . self::max_sommet);
                exit();
            }
        }
        return $altitudes;
    }

    private function getSafezone($largeur, $terrain)
    {
        $altitudes = explode(" ", $terrain);
        $diff = 0;
        $hauteur = $altitudes[0];
        for ($i = 0; $i < $largeur; ++$i) {
            if ($hauteur >= $altitudes[$i]) {
                $diff++;
            }
        }
        echo "La surface d'abri disponible = " . $diff . "<br>";
    }
    private function convertToMemory($size)
    {
        $unit = array('byte', 'kbyte', 'mByte', 'gbyte', 'tbyte', 'pbyte');
        return round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }
}
