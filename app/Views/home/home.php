<div class="row" id="home_container">


    <div id="contact_form">


        <div class="content">
            <div class="cardId">
                <div class="firstinfo">
                    <img src="<?= filter_var(App\App::getInstance()->getBaseUrl(),
                        FILTER_SANITIZE_STRING); ?>public/css/logo.svg"/>
                    <div class="profileinfo">
                        <h1>Renard Gris</h1>
                        <h3>Developpeur polyglotte</h3>
                        <button type="button" class="btn_modal" data-toggle="modal" data-target="#exampleModalCenter">
                            Contacter
                        </button>
                        <a href="<?= filter_var(App\App::getInstance()->getBaseUrl(),
                            FILTER_SANITIZE_STRING); ?>public/cv.pdf" download="cv.pdf">
                            <button type="button" class="btn_modal">
                                Curriculum
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="badgescard">
                <a href="https://github.com/RenardGris" class="social_link"><span class="fa fa-github"></span>
                    RenardGris</a>
                <span class="social_link"><span class="fab fa-discord"></span> RenardGris#0578</span>
            </div>
        </div>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="post">
                            <?= filter_var($form->input('firstname', 'Prenom')); ?>
                            <?= filter_var($form->input('lastname', 'Nom')); ?>
                            <?= filter_var($form->input('email', 'Email', ['type' => 'email'])); ?>
                            <?= filter_var($form->input('subject', 'Sujet')); ?>
                            <?= filter_var($form->input('content', 'Contenu', ['type' => 'textarea'])); ?>
                            <button class="btn" id="btn_contact_post">Envoyer</button>
                            <button type="button" class="btn" id="btn_contact_close" data-dismiss="modal">Fermer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="notif">
            <?= !empty($notification) ? filter_var($notification) : null ?>
        </div>


    </div>


</div>
