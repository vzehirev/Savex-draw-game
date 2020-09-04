<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Response;
use Illuminate\Http\Request;
use DB;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class ExportController extends Controller {
    public function exportp() {
        
        $table = DB::table('participants')->get();
        
        $path = join(DIRECTORY_SEPARATOR, array(base_path(), '..', 'public_html', 'kupisavex.com', 'export')) . DIRECTORY_SEPARATOR . 'participants.csv';

        $fp = fopen($path, 'w');
        
        foreach ($table as $fields) {
            fputcsv($fp, get_object_vars($fields));
        }

        fclose($fp);

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="participants.csv"'
        );

        return redirect('http://kupisavex.com/export/participants.csv', 302, $headers);
    }
}