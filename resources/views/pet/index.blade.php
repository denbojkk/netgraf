<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Petstore</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class = "container">
        <div class = "row text-center mt-2 col-6 mx-auto">
            <div class = "fs-6 text-center">Denis Bojar, zadanie rekrutacyjne</div>

            <hr />

            @if($errors->any())
            <div class="alert alert-danger"><i class="fas fa-info-circle"></i> Wystąpił problem
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success"><i class="fas fa-info-circle"></i> {{ session('success') }}
                </div>
            @endif

            <h1>Dodaj zwierzaka</h1>

            <form method = "POST" id = "form_pet_create" action = "{{ route('pet.create') }}">
                @csrf

                @method('PUT')

                <input class = "form-control form-control-sm" type = "text" name = "form_pet_name" placeholder = "Nazwa zwierzaka"/>

                <button class = "btn btn-primary m-2" form = "form_pet_create" type = "submit">Wyślij</button>
            </form>

            <hr />

            <h1>Znajdź zwierzaka</h1>

            <form method = "POST" id = "form_pet_find" action = "{{ route('pet.find') }}">
                @csrf

                <input class = "form-control form-control-sm" type = "text" name = "form_find_pet_id" placeholder = "ID zwierzaka"/>

                <button class = "btn btn-primary m-2" form = "form_pet_find" type = "submit">Wyślij</button>
            </form>

            <h1>Zmień nazwę zwierzaka</h1>

            <form method = "POST" id = "form_edit_pet" action = "{{ route('pet.edit') }}">
                @csrf

                @method('PUT')

                <input class = "form-control form-control-sm mb-2" type = "text" name = "form_edit_pet_pet_id" placeholder = "ID zwierzaka"/>
                <input class = "form-control form-control-sm" type = "text" name = "form_edit_pet_pet_name" placeholder = "Nowa nazwa zwierzaka"/>

                <button class = "btn btn-primary m-2" form = "form_edit_pet" type = "submit">Wyślij</button>
            </form>

            <h1>Usuń zwierzaka</h1>

            <form method = "POST" id = "form_delete_pet" action = "{{ route('pet.delete') }}">
                @csrf

                @method('DELETE')

                <input class = "form-control form-control-sm" type = "text" name = "form_delete_pet_pet_id" placeholder = "ID zwierzaka"/>

                <button class = "btn btn-primary m-2" form = "form_delete_pet" type = "submit">Wyślij</button>
            </form>
        </div>
    </div>
</body>
</html>
