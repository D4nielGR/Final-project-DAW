<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReportUploadController extends AbstractController
{
    #[Route('/report', name: 'app_report')]
    public function captureReport(): Response
    {
        return $this->render('reports/reportUpload.html.twig');
    }

    #[Route('/upload-report', name:'upload_report', methods:"POST")]
    public function uploadReport(Request $request): Response
    {
        $photoData = $request->request->get('photoData');
        $latitude = $request->request->get('latitude');
        $longitude = $request->request->get('longitude');

        if ($photoData && $latitude && $longitude) {
            // Decodificar la imagen base64
            $photoData = str_replace('data:image/png;base64,', '', $photoData);
            $photoData = base64_decode($photoData);
            $filePath = $this->getParameter('kernel.project_dir') . 'public/storageDB/images/reports' . time() . '.png';

            // Guardar la imagen en el servidor
            file_put_contents($filePath, $photoData);

            // Guardar la ubicación y la ruta de la imagen en la base de datos o manejarlo según tu lógica
            // Aquí puedes añadir el código para guardar $filePath, $latitude y $longitude en la base de datos

            return new Response('Foto y ubicación guardadas correctamente');
        }

        return new Response('Error al procesar la solicitud', 400);
    }
}
