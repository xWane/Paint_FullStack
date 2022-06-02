<?php
require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$document = new Dompdf();
// Changer le file par celui dont on veut change en pdf
// Changer PAINT.php par fichier final de paint
$page = file_get_contents("Paint_div.php");
$document->loadHtml($page);

$document->setPaper('A4', 'landscape');

$document->render();

$document->stream();
?>