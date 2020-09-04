<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Participant;

use App\Emailer;

use \Throwable;

class RegisterController extends Controller {
    private $participant;
    private $emailer;
    private $errors = [];

    function __construct() {
        $this->emailer = new Emailer();
    }

    function registerParticipant() {

        if (!isset($_POST['checkbox1'])
        || !isset($_POST['checkbox2'])
        || !isset($_POST['checkbox3'])) {
            $this->errors[] = "Моля, приемете официалните правила на промоцията";
        }
        
        $email = $_POST['email'];
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Невалиден имейл';
        }
        
        if (!isset($_POST['number']) || strlen($_POST['number']) != 10 || !is_numeric($_POST['number'])) {
            
            $this->errors[] = 'Моля, въведете всички десет цифри от номера на касовия бон, включително нулите отпред.';
        }
        
        $number = $_POST['number'];

        $photoSize = ($_FILES['photo']['size']) / 1048576;

        if ($photoSize > 10) {
            $this->errors[] = 'Размерът на изображението е прекалено голям';
        }

    
        $uploaDir = join(DIRECTORY_SEPARATOR, array(base_path(), '..', 'public_html', 'kupisavex.com', 'receipts')) . DIRECTORY_SEPARATOR;

        $photoExtension = explode('.', $_FILES['photo']['name']);
        $photoExtension = strtolower($photoExtension[sizeof($photoExtension)-1]);
        if ($photoExtension != "jpg"
        && $photoExtension != "jpeg"
        && $photoExtension != "png") {
            $this->errors[] = 'Невалиден формат на изображението. Разрешени формати: .jpg, .jpeg, .png';
        }

        $destinationPhoto = $uploaDir . $email . '_' . $number . '.' . $photoExtension;

        if (count($this->errors) > 0) {
            return redirect('/#test')->withInput()->withErrors($this->errors);
        }

        $userPhoto = $_FILES['photo']['tmp_name'];

        self::resizePhoto($userPhoto, $photoExtension);
        
        \move_uploaded_file($userPhoto, $destinationPhoto);

        $participant = new Participant();

        $photoUrl = 'http://kupisavex.com/receipts/' . $email . '_' . $number . '.' . $photoExtension;

        $participant->email = $email;
        $participant->number = $number;
        $participant->image = $photoUrl;

        try {
            $participant->save();
        } catch (\PDOException $th) {
            $this->errors[] = "Грешка при регистрация или касовият бон е вече използван";
        }

        if (count($this->errors) > 0) {
            return redirect('/#test')->withInput()->withErrors($this->errors);
        }
        
        $subject = "Успешна регистрация за играта на SAVEX";
        
        $body = "Здравейте! Вие успешно се регистрирахте с касов бон с номер " . $number . " за играта на SAVEX. Печелившите номера ще бъдат изтеглени до 22 ноември 2019 г. А дотогава не забравяйте да ни последвате в Instagram - https://bit.ly/savexinstagram, за да участвате в много други предизвикателства и да получите възможност да спечелите невероятен апарат за моментни снимки. Желаем Ви успех!";

        $this->emailer->sendEmail($email, $subject, $body);

        return redirect('/thankyou');
    }

    function resizePhoto(&$userPhoto, $photoExtension) {
        $photoSize = getimagesize($userPhoto);
        $photoWidth  = $photoSize[0];
        $photoHeight = $photoSize[1];
        if ($photoWidth >= $photoHeight && $photoWidth > 1100) {
            $newWidth = 1100;
            $newHeight = $photoHeight / ($photoWidth/ $newWidth);
            $source = imagecreatefromstring(file_get_contents($userPhoto));
            $destination = imagecreatetruecolor($newWidth, $newHeight );
            imagecopyresampled($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $photoWidth, $photoHeight);
            imagedestroy($source);
            if ($photoExtension == "jpg" || $photoExtension == "jpeg") {
                imagejpeg($destination, $userPhoto);
            } else {
                imagepng($destination, $userPhoto);
            }
            imagedestroy($destination);
        } else if ($photoHeight > $photoWidth && $photoHeight > 1100) {
            $newHeight = 1100;
            $newWidth = $photoWidth / ($photoHeight/ $newHeight);
            $source = imagecreatefromstring(file_get_contents($userPhoto));
            $destination = imagecreatetruecolor($newWidth, $newHeight );
            imagecopyresampled($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $photoWidth, $photoHeight);
            imagedestroy($source);
            if ($photoExtension == "jpg" || $photoExtension == "jpeg") {
                imagejpeg($destination, $userPhoto);
            } else {
                imagepng($destination, $userPhoto);
            }
            imagedestroy($destination);
        }
    }

    function thankYou() {
        return view('thankyou');
    }
}