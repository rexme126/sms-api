<?php

namespace App\GraphQL\Queries\Student;

use App\Models\Student;
use App\Models\Workspace;
use Illuminate\Support\Facades\Storage;

final class StudentPhotoQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */

    public function __invoke($_, array $args)
    {
        $workspace = Workspace::findOrFail($args['workspaceId']);
        $student = Student::find($args['studentId']);
        $logoImagePath = 'public/' . $workspace->id . '/logo' . '/' . $workspace->logo;
        $stampImagePath = 'public/' . $workspace->id . '/stamp' . '/' . $workspace->stamp;
        $photoImagePath = 'public/' . $workspace->id . '/students' . '/' . $student->photo;

        // // Read the image file into a string
        $logoBase64 = Storage::get($logoImagePath);
        $stampBase64 = Storage::get($stampImagePath);
        $photoBase64 = Storage::get($photoImagePath);

        // // Convert the image data to base64 encoding
        $logoBase64Image = base64_encode($logoBase64);
        $stampaBse64Image = base64_encode($stampBase64);
        $photoBase64Image = base64_encode($photoBase64);
        return [
            'id' => $student->id,
            'logoBase64' =>  $logoBase64Image,
            'stampBase64' =>  $stampaBse64Image,
            'photoBase64' =>  $photoBase64Image
        ];
    }
}
