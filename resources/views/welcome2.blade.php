<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5S7FWCK');</script>
<!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('la-assets/css/mainCustom.css') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Exo+2:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic"
        rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>Savex</title>
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5S7FWCK"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <!--Главна станица -->


    <div class="main-wrapper">

        <div class="section-home">
            <header class="header">
                <div class="logocontainer">
                    <IMG SRC="la-assets/images/SAVEX-LOGO-.png" ALT="some text" class="logo">
                </div>
            </header>
            <div class="contenthome">
                    <div class="logocontainerdesktop">
                            <IMG SRC="la-assets/images/SAVEXLOGOdesktop.png" ALT="some text" class="logodesktop">
                        </div>
                <div class="containerhome">
                        
                    <div class="badgecontainer">
                        <IMG SRC="la-assets/images/badge.png" ALT="some text" class="badge">
                    </div>
                    <div class="prizecontainer">
                        <IMG SRC="la-assets/images/400x.png" ALT="some text" class="fourhundred">
                        <h2><span>скролни</span> надолу, за да видиш как</h2>
                    </div>

                    <div class="scroll-downs">
                        <div class="mousey">
                            <div class="scroller"></div>
                        </div>
                    </div>
                </div>
                <div class="section-steps">
                    <div class="steponecontainer">
                        <IMG SRC="la-assets/images/1_desktop.png" ALT="some text" class="steponedesktop">
                    </div>

                    <div class="steponecontainer">
                            <IMG SRC="la-assets/images/1.png" ALT="some text" class="stepone">
                        </div>


                    <div class="preparaticontainer">
                        <IMG SRC="la-assets/images/preparati.png" ALT="some text" class="preparati">
                    </div>
                    <div class="steptwocontainer">
                        <IMG SRC="la-assets/images/2_desktop.png" ALT="some text" class="steptwodesktop">
                    </div>

                    <div class="steptwocontainer">
                            <IMG SRC="la-assets/images/2.png" ALT="some text" class="steptwo">
                        </div>
                </div>
            </div>

            <!-- -=-=-=-=-=-=-=-=-=-=-=-= -->
            <!-- -=-= REGISTERBOX -=-=-= -->
            <!-- -=-=-=-=-=-=-=-=-=-=-=-= -->
            <div class="section-register">
                <div class="container">
                    <div class="registerbox">
                        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="container">
                                <h1>РЕГИСТРИРАЙ СЕ</h1>
                                    @if ($errors->any())
                                    <div class="alert alert-danger" style="color: red">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                    </div>
                                @endif
                                <input type="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required>
                                <input type="text" placeholder="№ на касова бележка" name="number" value="{{ old('number') }}" required>

                                <div class="choose_file">
                                        <i class="fas fa-download icon uploadFileText" id="uploadIcon"></i>
                                    <span class="uploadFileText">Качи снимка на касовата бележка</span>
                                    <input class="fileUpload" onchange="fileUploaded()" name="photo" type="file" accept="image/png,image/jpeg,image/jpg;capture=camera" required>
                                </div>
                                <button type="submit" class="registerbtn">РЕГИСТРИРАЙ СЕ</button>

                                <br>

                                <input id="cb" name="checkbox1" type="checkbox" style="float: left; margin-top: 5px; color: white;" required>
                                <div class="cb">
                                    Прочетох и съм съгласен с <b> Официалните правила на Промоцията.</b>
                                    <br>
                                    <input id="cb1" name="checkbox2" type="checkbox" style="float: left; margin-top: 5px; color: white;" required>
                                    <div class="cb">
                                        Потвърждавам, че имам навършени 18 години;</div>
                                    <br>
                                    <input id="cb2" name="checkbox3" type="checkbox" style="float: left; margin-top: 5px; color: white;" required>
                                    <div class="cb">
                                        Съгласен съм с Политиката за поверителност и
                                        потвърждавам, че ако спечели двете ми имена и <br>
                                        имейл адресът ми ще бъдат публикувани на <br>
                                        www.kupisavex.com, по начинът, посочено в <br>
                                        Официалните правила на Промоцията.
                                        <br> <br>
                                       <em>(Може да оттеглите съгласието си по всяко
                                        време с изпращане на съобщение до
                                        admin@stellary.bg. Оттеглянето на съгласието
                                        не засяга законността на обработването,
                                        извършено преди оттеглянето.).</em> 
                                    </div>
                                    <br>

                                </div>
                        </form>

                    </div>
                </div>
            </div>

             <!-- -=-=-=-=-=-=-=-=-=-=-=-= -->
        <!-- -=-= FOOTER -=-=-= -->
        <!-- -=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="section-footer">
                    <nav class="footernav">
                            <ul class="menu">
                                    <li>
                                        <a href="{{ route('prizes') }}" class="animated fadeInLeft">НАГРАДИ</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('rules') }}" class="animated fadeInLeft">ПРАВИЛА</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('winners') }}" class="animated fadeInLeft">ПЕЧЕЛИВШИ</a>
                                    </li>
                                </ul>

                    </nav>
            <div class="container">
                <div class="content">
                    <h2>МОЖЕШ ДА НИ ПОСЛЕДВАШ В:</h2>
                    <div class="icons">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-instagram"></i>
                    <IMG SRC="la-assets/images/savexicon.png" ALT="some text" class="savexicon">
                </div>
                </div>
                <br>
            </div>
            <div class="greenbackground">
                <br>
                <h1>©2019 SAVEX I ALL RIGHTS RESERVED</h1>
                <p>Powered by Stellaryagency</p>
            </div>
        </div>
  
  
  

        </div>
    </div>




</body>

<script>
    function chooseFile() {
        document.getElementById("fileInput").click();
    }

    function fileUploaded() {
        let fileName = $('.fileUpload').val().split('\\').pop();
        let uploadSuccess = "Файлът е качен успешно.";
        $('span.uploadFileText').text(uploadSuccess);
        $('#uploadIcon').removeClass('fa-download').addClass('fa-check');
        $('.fa-check').css('color', 'green');
    }
</script>

</html>