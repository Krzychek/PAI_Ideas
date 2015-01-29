<?php $options = [
    ['href' => "/ideas", 'name' => 'MakeApp!'],
    ['href' => "/idea/new", 'name' => 'Dodaj pomysł', 'perm' => 'add_idea'],
    ['href' => "/users/manage", 'name' => 'zarządzaj użytkownikami', 'perm' => 'full']
] ?>
<div class="top_panel">
    <ul class="main_menu">
        <?php foreach ($options as $opt) {
            if (!isset($opt['perm']) || Auth::check_perm($opt['perm'])) { ?>
                <li><a href="<?= $GLOBALS['mainFolder'] . $opt['href'] ?>"><?= $opt['name'] ?></a></li>
            <?php }
        } ?>
        <li style="float: right;"><a href="<?= $GLOBALS['mainFolder'] ?>/Auth/logout" class="switch"> wyloguj </a>
            <a class="switch">
                <span style="text-decoration: underline;"><?= $GLOBALS['login'] ?></span>
            </a>
        </li>
    </ul>
</div>
