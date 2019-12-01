<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <link rel="stylesheet" href="{!! asset('assets/plugins/fontawesome-free/css/all.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('assets/dist/css/adminlte.min.css') !!}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h2 class="page-header">
                    <img src="{{asset('public/image/'. $hotel->logo)}}" class="avatar avatar-16 img-circle" style="width: 50px; height: 50px"> {{ $hotel->nom }}
                    <small class="float-right">Date: {{ date('Y-m-d') }}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>{{ $hotel->nom }} .</strong><br>
                    {{ $hotel->adresse }}<br>
                    tel: {{ $hotel->telephone }}<br>
                    Email: {{ $hotel->email }}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Pour
                <address>
                    <strong>{{ $reservation->client->prenom }} {{ $reservation->client->nom }}</strong><br>
                    {{ $reservation->client->adresse }}<br>
                    Tel: {{ $reservation->client->telephone }}<br>
                    Email: {{ $reservation->client->email }}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>N°Reservation {{ $reservation->id }}</b><br>
                {{--<br>
                <b>Order ID:</b> 4F3S8J<br>
                <b>Payment Due:</b> 2/22/2014<br>
                <b>Account:</b> 968-34567--}}
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Date Debut</th>
                        <th>Date Fin</th>
                        <th>Chambre</th>
                        <th>Nombre de Nuité</th>
                        <th>Tarif</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $reservation->date_arrivee }}</td>
                        <td>{{ $reservation->date_depart }}</td>
                        <td>@foreach($reservation->affectes as $affecte)
                                chambre N°{{ $affecte->chambre_id }},
                            @endforeach</td>
                        <td>{{ $jour }}</td>
                        <th>{{ $reservation->tarif->prix }}</th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">

            </div>
            <!-- /.col -->
            <div class="col-6">

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Montant Reservation:</th>
                            <td>{{ $montantNuite }} CFA</td>
                        </tr>
                        <tr>
                            <th>Montant Restauration</th>
                            <td>0</td>
                        </tr>

                        <tr>
                            <th>Total:</th>
                            <td>{{ $montantNuite }} CFA</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>
</body>
</html>
