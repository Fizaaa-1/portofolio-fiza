<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portofolio Muhammad Fiqri Fahreza</title>
    <link rel="stylesheet" href="stylee.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style>
        /* Tambahkan CSS untuk Hasil Web di bawah */
        /* Style untuk header dan navigasi */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #333;
            color: white;
        }

        

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .navlinks {
            list-style-type: none;
            display: flex;
        }

        .navlinks li {
            margin-left: 20px;
        }

        .navlinks a {
            text-decoration: none;
            color: white;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .navlinks a:hover {
            color: #ff512f;
        }

        /* Style untuk halaman hasil web */
        #hasil-web {
            background-color: #f4f4f4;
            padding: 50px 0;
        }

        #hasil-web .container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .web-gallery {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 30px;
        }

        .web-item {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 30%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .web-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .web-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .web-item h3 {
            font-size: 1.5rem;
            margin-top: 20px;
            color: #333;
        }

        .web-item p {
            font-size: 1rem;
            color: #666;
            margin: 10px 0 20px;
        }

        .web-item .btn.active {
            display: inline-block;
            background-color: #6a11cb;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .web-item .btn.active:hover {
            background-color: #2575fc;
        }

        /* Hero section */
        .hero-header {
            background-image: url('background.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .hero-header .wrapper {
            text-align: center;
            padding: 50px;
        }

        .hero-header .logo-text {
            font-size: 3rem;
            font-weight: bold;
            margin-left: 10px;
        }

        .hero-header .hero-text h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-top: 10px;
        }

        .hero-header .btn-group .btn {
            padding: 12px 25px;
            margin: 10px;
            font-size: 1rem;
            text-decoration: none;
            color: white;
            background-color: #6a11cb;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .hero-header .btn-group .btn:hover {
            background-color: #2575fc;
        }

        .social a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social a:hover {
            color: #ff512f;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <i class="fa-solid fa-m"></i>
            <div class="logo-text">M. Fizaa</div>
        </div>
        <nav>
            <ul class="navlinks">
                <li><a href="indexx.html">Home</a></li>
                <li><a href="hasil-web.php">Hasil Web</a></li>
                <li><a href="#">Resume</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hasil Web Section -->
    <section id="hasil-web">
        <div class="container">
           
            <div class="web-gallery">
                <div class="web-item">
                    <img src="web1.png" alt="Project 1" />
                    <h3>Project 1</h3>
                    <p>ini adalah website data mahasiswa yang pernah saya bikin</p>
                    <a href="index.php" target="_blank" class="btn active">Lihat Proyek</a>
                </div>
                <div class="web-item">
                    <img src="web2.png" alt="Project 2" />
                    <h3>Project 2</h3>
                    <p>ini adalah website E-commerce saya yang pernah saya bikin</p>
                    <a href="https://mfikrifahreza.github.io/Website-E-commerce/index.html" target="_blank" class="btn active">Lihat Proyek</a>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.10/typed.min.js"></script>
    <script>
        var typed = new Typed(".input", {
            strings: ["Frontend Developer", "UX Designer", "Web Developer"],
            typeSpeed: 70,
            backSpeed: 55,
            loop: true,
        });
    </script>
</body>

</html>
