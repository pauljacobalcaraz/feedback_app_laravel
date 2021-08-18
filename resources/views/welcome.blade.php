<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Feedback</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-md-flex justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav mr-3">
                    <div class="ml-3 navbar-nav mr-3">
                        <li class="nav-item"><a class="nav-link" href="/login" type="button">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="/register" type="button">Register</a></li>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mb-4">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="{{asset('images/landing_page')}}/add-company-add-product.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title">Company</h5>
                        <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Temporibus, cumque deleniti reiciendis molestiae sapiente atque facilis amet nisi et iure corrupti libero hic rem expedita autem assumenda ducimus saepe. Sunt alias nemo facilis facere sint aliquam, ut molestias possimus deserunt suscipit voluptate minima assumenda a excepturi magni minus cumque vero, nisi laudantium ipsum recusandae. Eligendi, minus officia! Quam sunt quisquam officiis corrupti repudiandae facilis iusto ipsa, unde itaque quae nostrum excepturi assumenda, error eligendi. Enim dolorum nulla non et expedita consequatur sit magni cumque aliquam officia culpa dolorem eaque ex, possimus quis sequi nobis, voluptatibus, nesciunt laboriosam quasi sapiente esse!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title">Manage Product</h5>
                        <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Temporibus, cumque deleniti reiciendis molestiae sapiente atque facilis amet nisi et iure corrupti libero hic rem expedita autem assumenda ducimus saepe. Sunt alias nemo facilis facere sint aliquam, ut molestias possimus deserunt suscipit voluptate minima assumenda a excepturi magni minus cumque vero, nisi laudantium ipsum recusandae. Eligendi, minus officia! Quam sunt quisquam officiis corrupti repudiandae facilis iusto ipsa, unde itaque quae nostrum excepturi assumenda, error eligendi. Enim dolorum nulla non et expedita consequatur sit magni cumque aliquam officia culpa dolorem eaque ex, possimus quis sequi nobis, voluptatibus, nesciunt laboriosam quasi sapiente esse!</p>
                    </div>
                </div>
                <div class="col-md-5">
                    <img src="{{asset('images/landing_page')}}/product.jpg" class="img-fluid rounded-start" alt="...">
                </div>
            </div>
        </div>
    </div>
</body>

</html>