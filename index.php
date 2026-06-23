<?php
$nome1 = "Giovanna";
$nome2 = "Kethleen";
$cargo = "Software Engineer";
$empresa = "Serasa Experian";
$stack = ["PHP", "Laravel", "Angular", "Python", "ReactJS"];
$linkedin = "https://www.linkedin.com/in/giovannakethleen/";
$github = "https://github.com/giovannakethleen";

$projetos = [
    ["numero"=>"01","titulo"=>"RocketNotes","descricao"=>"Aplicação web para criação e organização de notas, com autenticação de usuários e categorização por tags.","tags"=>["NodeJS","ReactJS"],"link"=>"https://github.com/giovannakethleen/rockeatnotesFront"],
    ["numero"=>"02","titulo"=>"Gerador de Certificados","descricao"=>"Sistema para criação automática de certificados personalizados a partir de templates e listas de participantes.","tags"=>["Angular","TypeScript"],"link"=>"https://github.com/giovannakethleen/Certificad"],
    ["numero"=>"03","titulo"=>"Links","descricao"=>"Página de links personalizados no estilo Linktree. Meu primeiro projeto, desenvolvido em 2023.","tags"=>["HTML","CSS","JavaScript"],"link"=>"https://github.com/giovannakethleen/links"],
    ["numero"=>"04","titulo"=>"Formulário de Eventos","descricao"=>"Formulário de inscrição para eventos com validação de campos. Meu segundo projeto, desenvolvido em 2023.","tags"=>["HTML","CSS","JavaScript"],"link"=>"https://github.com/giovannakethleen/form"],
];

$contatos = [
    ["icon"=>"bi-linkedin","titulo"=>"LinkedIn","descricao"=>"Vamos nos conectar profissionalmente","link"=>$linkedin,"destaque"=>true],
    ["icon"=>"bi-github","titulo"=>"GitHub","descricao"=>"Confira meu código e repositórios","link"=>$github,"destaque"=>false],
];

$ano = date("Y");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($nome1 . ' ' . $nome2) ?> | Portfólio</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="nebula-bg">
        <div class="nebula-blob b1"></div>
        <div class="nebula-blob b2"></div>
        <div class="nebula-blob b3"></div>
        <div class="nebula-blob b4"></div>
    </div>
    <canvas id="stars-canvas"></canvas>

    <nav class="navbar navbar-expand-lg fixed-top custom-navbar">
        <div class="container">
            <a class="navbar-brand brand-logo" href="#topo">
                <span class="brand-dot"></span> <?= strtolower(substr($nome1,0,1).substr($nome2,0,1)) ?>.
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                <ul class="navbar-nav align-items-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link" href="#sobre">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projetos">Projetos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header id="topo" class="hero">
        <div class="container">
            <div class="col-lg-9">
                <h1 class="hero-title">
                    <span class="d-block"><?= htmlspecialchars($nome1) ?></span>
                    <span class="d-block gradient-text"><?= htmlspecialchars($nome2) ?></span>
                </h1>
                <p class="hero-subtitle">
                    <?= htmlspecialchars($cargo) ?> na <strong><?= htmlspecialchars($empresa) ?></strong>.<br>
                    Construo produtos com
                    <?php foreach ($stack as $i => $tech): ?>
                        <strong><?= htmlspecialchars($tech) ?></strong><?= $i < count($stack)-1 ? ($i == count($stack)-2 ? ' e ' : ', ') : '' ?>
                    <?php endforeach; ?>.
                </p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="#projetos" class="btn btn-gradient">Ver projetos <i class="bi bi-arrow-up-right"></i></a>
                    <a href="<?= htmlspecialchars($linkedin) ?>" target="_blank" class="btn btn-glass"><i class="bi bi-linkedin"></i> LinkedIn</a>
                </div>
            </div>
        </div>
        <div class="scroll-indicator"><i class="bi bi-chevron-down"></i></div>
    </header>

    <section id="sobre" class="section-padding">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <span class="section-label">SOBRE</span>
                    <h2 class="section-title">Engenharia de software<br>com foco em entrega.</h2>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <p class="lead-text">Sou <?= htmlspecialchars($cargo) ?> na <strong><?= htmlspecialchars($empresa) ?></strong>, onde trabalho com <strong><?= htmlspecialchars($stack[0]) ?></strong>, <strong><?= htmlspecialchars($stack[1]) ?></strong> no back-end e <strong><?= htmlspecialchars($stack[2]) ?></strong> no front-end.</p>
                    <p class="lead-text muted">Gosto de código limpo, arquitetura bem pensada e produtos que resolvem problemas reais. Estou sempre buscando aprender algo novo e melhorar o que já existe.</p>
                    <div class="row mt-5 g-4">
                        <?php foreach ([
                            ["bi-code-slash","Back-end","PHP, Laravel, Python"],
                            ["bi-window-stack","Front-end","Angular, TypeScript, ReactJS, Bootstrap"],
                            ["bi-database","Banco de Dados","Oracle, PostgreSQL"],
                        ] as [$icon, $title, $desc]): ?>
                        <div class="col-md-4">
                            <div class="skill-card">
                                <i class="bi <?= $icon ?>"></i>
                                <h5><?= $title ?></h5>
                                <p><?= $desc ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="projetos" class="section-padding">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap mb-5 gap-3">
                <div>
                    <span class="section-label">PROJETOS</span>
                    <h2 class="section-title mb-0">Trabalhos selecionados</h2>
                </div>
                <a href="<?= htmlspecialchars($github) ?>" target="_blank" class="btn btn-glass"><i class="bi bi-github"></i> github</a>
            </div>
            <div class="row g-4">
                <?php foreach ($projetos as $i => $p): ?>
                <div class="col-md-6">
                    <a href="<?= htmlspecialchars($p['link']) ?>" target="_blank" class="project-card-link">
                        <div class="project-card <?= $i === 0 ? 'featured' : '' ?>">
                            <div class="project-top">
                                <span class="project-number"><?= $p['numero'] ?></span>
                                <i class="bi bi-arrow-up-right project-arrow"></i>
                            </div>
                            <h3 class="project-title"><?= htmlspecialchars($p['titulo']) ?></h3>
                            <p class="project-desc"><?= htmlspecialchars($p['descricao']) ?></p>
                            <div class="project-tags">
                                <?php foreach ($p['tags'] as $tag): ?>
                                    <span class="tag-pill"><?= htmlspecialchars($tag) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="contato" class="section-padding">
        <div class="container">
            <div class="contact-wrapper">
                <div class="contact-orbit">
                    <div class="orbit-ring r1"></div>
                    <div class="orbit-ring r2"></div>
                    <div class="orbit-dot d1"></div>
                    <div class="orbit-dot d2"></div>
                    <div class="orbit-dot d3"></div>
                </div>
                <div class="row align-items-center g-5">
                    <div class="col-lg-5">
                        <span class="section-label">CONTATO</span>
                        <h2 class="contact-title">Vamos criar algo<br><span class="gradient-text">fora desse mundo</span>?</h2>
                        <p class="lead-text mt-3">Estou aberta a novas oportunidades, colaborações e boas conversas sobre tecnologia. Escolha o canal que preferir.</p>
                    </div>
                    <div class="col-lg-7">
                        <div class="contact-channels">
                            <?php foreach ($contatos as $c): ?>
                            <a href="<?= htmlspecialchars($c['link']) ?>" target="_blank" class="contact-channel <?= $c['destaque'] ? 'featured' : '' ?>">
                                <div class="channel-icon"><i class="bi <?= $c['icon'] ?>"></i></div>
                                <div class="channel-text">
                                    <h5><?= htmlspecialchars($c['titulo']) ?></h5>
                                    <p><?= htmlspecialchars($c['descricao']) ?></p>
                                </div>
                                <i class="bi bi-arrow-up-right channel-arrow"></i>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer text-center">
        <p>&copy; <?= $ano ?> <?= htmlspecialchars($nome1 . ' ' . $nome2) ?></p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>