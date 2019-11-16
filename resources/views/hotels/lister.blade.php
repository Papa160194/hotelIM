@extends('welcome')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-info">GESTION DES HOTELS</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="" role="button" class="btn btn-primary">ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('hotels.create') }}" role="button" class="btn btn-primary">AJOUTER UN HÔTEL</a></li>
                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
    </div>

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="col-12">
            <div class="card border-danger border-0">
                <div class="card-header bg-info text-center">LISTE D'ENREGISTREMENT DES CLIENTS</div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-responsive-md table-striped text-center">
                            <thead>
                                <tr>
                                    <th>logo</th>
                                    <th>Nom</th>
                                    <th>adresse</th>
                                    <th>téléphone</th>
                                    <th>email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hotels as $hotel)
                                    <tr>
                                        <td><img src="{{asset('public/image/'. $hotel->logo)}}" class="avatar avatar-16 img-circle" style="width: 50px; height: 50px"> </td>
                                            <td>{{$hotel->nom}}</td>
                                            <td>{{$hotel->adresse}}</td>
                                            <td>{{$hotel->telephone}}</td>
                                            <td>{{$hotel->email}}</td>
                                            <td>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['hotels.destroy', $hotel->id] ]) !!}
                                            <a href="{{ URL::to('hotels/'.$hotel->id.'/edit') }}" class="btn btn-warning pull-left" ><i class="far fa-edit"></i></a>
                                            <button class="btn btn-danger border-left-0 border" type="submit">
                                            <i class="far fa-trash-alt"></i>
                                            </button>
                                            {!! Form::close() !!}
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                            </div>

                                    <div class="text-center">
                                        {{ $hotels->links() }}
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
