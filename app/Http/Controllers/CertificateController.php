<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function generateCertificate(Request $request, Course $course)
    {
        $user = $request->user();

        // Check if the user has completed the course (you can add your own logic here)
        $courseCompleted = true; // Replace with actual course completion check

        if ($courseCompleted) {
            // Generate the certificate PDF
            $pdf = Pdf::loadView('certificates.template', compact('user', 'course'));

            // Save the PDF to storage
            $fileName = 'certificates/' . $user->id . '_' . $course->id . '.pdf';
            Storage::put($fileName, $pdf->output());

            // Save the certificate record to the database
            $certificate = Certificate::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'certificate_url' => $fileName,
            ]);

            return response()->json([
                'message' => 'Certificate generated',
                'certificate' => $certificate
            ]);
        }

        return response()->json(['message' => 'Course not completed'], 400);
    }

    public function downloadCertificate(Certificate $certificate)
    {
        $filePath = $certificate->certificate_url;

        if (is_null($filePath) || !Storage::exists($filePath)) {
            return response()->json(['message' => 'File not found'], 404);
        }

        return Storage::download($filePath);
    }
}
