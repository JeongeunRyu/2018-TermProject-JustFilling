<!DOCTYPE html>
<html>
<head>
    <?php require_once ("htmlHead.php"); ?>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Abril+Fatface');
        @import url('https://fonts.googleapis.com/css?family=Nanum+Myeongjo:800');
        .dropdown-menu{
            border-radius: 1rem;
            text-align: center;
        }
        .form-control{
            border-radius: 1.5rem;
        }
        body{
            outline: none;
            border: none;
        }
        .mcr-info{
            margin-bottom: 1%;
        }

        .mcr_text{
            font-family: 'Abril Fatface', cursive;
            font-size: 5em;
        }

        .mcr_txt_sc{
            margin-bottom: 2.5%;
            font-family: 'Nanum Myeongjo',serif;
            font-size: 1.2em;
        }
        .aboutmacaron{
            margin-top: 2.5%;
            margin-bottom: 2.5%;
            margin-left: 44.5%;

        }
        .ab{
            border-radius: 2rem;
        }
        .sp{
            background-color: #6c6783;
            color: white;
        }

    </style>
</head>
<body>
    <?php require_once ("nav.php"); ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="/201802/term/media/1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/201802/term/media/2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/201802/term/media/3.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="aboutmacaron"><a class="btn btn-outline-primary btn-lg ab" href="#about">about MACARON</a></div>
    <?php require_once ("info.php"); ?>
    <?php require_once ("footer.php"); ?>
    <script>
        $(document).ready(function() {

            if (window.location.hash == "#login") {
                $(".dropdown-toggle").click();
            }
            ;


            $("#cou").mouseover(function () {
                $(".mcr-img").attr("src", "../media/mcr_c.png");
            });

            $("#fil").mouseover(function () {
                $(".mcr-img").attr("src", "../media/mcr_f.png");
            });
            $(".mcr-info").mouseout(function(){
                $(".mcr-img").attr("src", "../media/mcr_full.png");
            });
            $('.mcr-info').click(function() {

                $('.'+ this.id).toggle();
            });

                $('.ab').click((e) => {
                    const target = $(e.target.hash);

                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 800);

                    return false;

                });


        })


    </script>
</body>
</html>