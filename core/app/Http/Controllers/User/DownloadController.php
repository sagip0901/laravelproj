<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\Writer\PDF as WriterPDF;

class DownloadController extends Controller {

    public function pdfContent(Request $request) {
        $content = $request->content;
        $pdf     = PDF::loadView('Template::user.download.pdf_content', compact('content'));
        return $pdf->download('document.pdf');
    }

    public function wordContent(Request $request) {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $content = $request->content;
        Html::addHtml($section, $content);

        $tempFilePath = tempnam(sys_get_temp_dir(), 'wordFile');
        $objWriter    = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFilePath);

        $fileContent = file_get_contents($tempFilePath);
        unlink($tempFilePath);
        return response($fileContent)
            ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="document.docx"');
    }
}
