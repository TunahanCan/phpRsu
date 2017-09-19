<html>
<head>
    <title>Rsu Projesi</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rsu Uygulama Projesi</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <style type="text/css" media="screen">

        .col-md-offset-36 {

            margin-left: 36%;

        }


        .margin-top20 {

            margin-top: 20px;

        }


        .margin-top100 {

            margin-top: 100px !important;

        }


        .b-white {

            background-color: #fff;

        }


        .content {

            min-height: 540px;

        }


        .footer {

            border-top: 1px solid #EDEDED;

        }


        .makeauthor {

            float: right;

        }

    </style>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

</head>

<body>
<form action="girisConfig.php" method="POST">

    <div class="container margin-top100">

        <div class="row">

            <div class="col-md-4 col-md-offset-36">



            </div>

            <div class="col-md-4 col-md-offset-4">

                <div class="panel panel-default">

                    <div class="panel-body">

                        <h5 class="text-center">

                            Yönetici Girişi</h5>

                        <form class="form form-signup" role="form" name="kullanici" method="POST" >

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>

                                    <input type="text" name="kullanici" class="form-control" placeholder="Yönetici Adınız" />

                                </div>

                            </div>

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>

                                    <input type="password" name="sifre" class="form-control" placeholder="Yönetici Şifreniz" />

                                </div>

                            </div>

                    </div>

                    <button type="submit" name="giris" class="btn btn-sm btn-primary btn-block" role="button">Giriş Yap</button>


</body>
</html>