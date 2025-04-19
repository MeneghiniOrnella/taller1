<!DOCTYPE html>
<html lang="es">
<!--
Le proponemos que retome la Actividad 2 de la Unidad 1 y genere el mismo código HTML pero ahora utilizando PHP. Envíe al tutor el archivo “. php”. 
http://localhost/taller1/u2/u2-a1.php 
-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ornella Meneghini</title>
</head>

<body>
    <header>
        <h1>Ornella Meneghini</h1>
        <nav>
            <?php $nav = ["Home", "About", "Contact"]; ?>
            <ul>
                <?php foreach($nav as $item) { ?>
                <li><a href="u1-a1.html"><?php echo $item; ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>
    <main>
        <img src="https://img.freepik.com/foto-gratis/concepto-fondo-programacion_23-2150170124.jpg?t=st=1742260057~exp=1742263657~hmac=e3321946a4775f27bf8d1735cd68de3bb78b7161eb1ae84365767a271b384a85&w=996"
            alt="Programación" width="300" height="200">
        <a
            href="https://www.freepik.es/foto-gratis/concepto-fondo-programacion_38169909.htm#fromView=search&page=1&position=33&uuid=e4a3a8e2-9f6e-49d3-bc73-fc9e5b80d7c8&query=programation">Imagen
            de freepik</a>
        <h2>Acerca de mi</h2>
        <p>En 2020 decidí transformar mi carrera y enfocarme en el desarrollo Full Stack. Actualmente, trabajo como
            desarrolladora mientras estudio una carrera técnica en programación, lo que me permite aplicar mis
            conocimientos en proyectos reales y fortalecer mis habilidades día a día.</p>
        <p>Me apasiona la tecnología y el aprendizaje continuo, por lo que siempre busco nuevas herramientas, cursos y
            recursos para seguir creciendo profesionalmente. Mi objetivo es convertirme en una programadora integral,
            dominando tanto el desarrollo frontend como backend para crear soluciones innovadoras y eficientes.</p>
        <br />
        <?php
            $educations = [
                [
                    "pretitle" => "Tec.",
                    "title" => "en Programación",
                    "start" => "2023",
                    "end" => "actualmente",
                    "endCurrently" => "En proceso"
                ],
                [
                    "pretitle" => "Lic.",
                    "title" => "en comercio internacional",
                    "start" => "2020",
                    "end" => "2021",
                    "endCurrently" => "Graduada"
                ],
                [
                    "pretitle" => "Tec.",
                    "title" => "en comercio internacional",
                    "start" => "2017",
                    "end" => "2020",
                    "endCurrently" => "Graduada"
                ]
            ];

            $works = [
                [
                    "title" => "Full Stack Developer Jr.",
                    "start" => "2022",
                    "end" => "actualmente",
                    "hard_skills" => "Vue, CSS, PHP, SASS, mySQL"
                ],
                [
                    "title" => "Full Stack Developer Trainee",
                    "start" => "2022",
                    "end" => "2022",
                    "hard_skills" => "Vue, CSS, mySQL, Bootstrap"
                ]
            ];
        ?>
        <h2>Educación</h2>
        <ul>
            <?php
                foreach($educations as $education) {
                    echo 
                        '<li>
                            <i>' . $education['start'] . ' - ' . $education['end'] . '</i><br>
                            <b>' . $education['pretitle'] . ' ' . $education['title'] . '</b>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt suscipit magnam nemo deserunt quia
                            labore nihil totam cumque, inventore fugiat asperiores, minus dolores molestiae quae quo, vitae exercitationem dignissimos alias!</p>
                        </li>';
                }
            ?>
        </ul>
        <h2>Trabajo</h2>
        <ul>
            <?php
                foreach($works as $work) {
                    echo 
                        '<li>
                            <i>' . $work['start'] . ' - ' . $work['end'] . '</i><br/>
                            <b>' . $work['title'] . '</b>
                            <p>Lenguajes de programación: <b>' . $work['hard_skills'] . '</b></p>
                        </li>';
                }
            ?>
        </ul>
        <hr />
        <a href="mailto:meneghini.ornella@gmail.com">Enviame un correo <img
                src="https://img.icons8.com/?size=100&id=xLIkjgcmFOsC&format=png&color=000000" alt="mail" width="20"
                height="20"></a>
    </main>
    <footer>
        <p>&copy; 2020 Ornella Meneghini</p>
    </footer>
</body>

</html>