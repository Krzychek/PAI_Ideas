<?php class vAdminUsers extends view
{
    private $users;

    function __construct($users)
    {
        $this->users = $users;
    }

    function view_body()
    {
        include('top_panel.php'); ?>
        <div class="content">
            <div class="major_section">
                <div class="idea_title">Lista użytkowników:</div>
                <ul class="user_list">
                    <?php foreach ($this->users as $user) { ?>
                        <li>
                            <?= $user['login'] ?>
                            - <a href="<?= $GLOBALS['mainFolder'] ?>/users/rmuser/<?= $user['login'] ?>">USUŃ</a>
                            , <a href="<?= $GLOBALS['mainFolder'] ?>/users/userideas/<?= $user['login'] ?>">wyświetl
                                pomysły</a>
                            , <a href="<?= $GLOBALS['mainFolder'] ?>/users/resetrep/<?= $user['login'] ?>">zresetuj
                                reputację</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php
    }

}