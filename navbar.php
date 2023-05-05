<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/index">
                <img src="/src/images/logo.svg" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class='navbar-nav ms-auto'>
                <?php
                    if((empty($_SESSION))){
                        echo("
                            <li class='nav-item'>
                                <a class='nav-link' data-bs-toggle='modal' data-bs-target='#exampleModal2'>Inscription</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' data-bs-toggle='modal' data-bs-target='#exampleModal1'>Connexion</a>
                            </li>
                        ");
                    }
                    else{
                        if(empty($_SESSION['role'])){
                            echo ("
                                <li class='nav-item'>
                                    <a class='nav-link' href='/profil.php'> Profil</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='logout.php'>Se déconnecter</a>
                                </li>
                            ");
                        }
                        else{
                            echo ("
                                <li class='nav-item'>
                                    <a class='nav-link' href='dashboard.php'> Dashboard</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='/profil.php'> Profil</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='logout.php'>Se déconnecter</a>
                                </li>
                            ");
                        }
                    }
                ?>
                </ul>
            </div>
        </div>
    </nav>