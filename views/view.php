<?php class view
{
    function render()
    { ?>
        <!doctype html>
        <html>
        <head>
            <title>MakeApp - place for app ideas</title>
            <meta charset="utf-8">
            <link rel="stylesheet" href="<?= $GLOBALS['mainFolder'] ?>/style/style.css">
            <?php $this->view_head(); ?>
        </head>
        <body>
        <?php $this->view_body(); ?>
        </body>
        </html>
    <?php }

    function view_head()
    {
    }

    function view_body()
    {
    }

    protected function parseBBCode(&$text)
    {
        $text = preg_replace("#\[b\](.*?)\[/b\]#si", '<b>\\1</b>', $text);
        $text = preg_replace("#\[u\](.*?)\[/u\]#si", '<u>\\1</u>', $text);
        $text = preg_replace("#\[s\](.*?)\[/s\]#si", '<s>\\1</s>', $text);
        return preg_replace("#\[i\](.*?)\[/i\]#si", '<i>\\1</i>', $text);
    }
}
