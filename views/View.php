<?php class View
{
    function view_head()
    {
    }

    function view_body()
    {
    }

    function render()
    { ?>
        <!doctype html>
        <html>
        <head>
            <title>MakeApp - place for app ideas</title>
            <meta charset="utf-8">
            <link rel="stylesheet" href="/makeapp/style/style.css">
            <?php $this->view_head(); ?>
        </head>
        <body>
        <?php $this->view_body(); ?>
        </body>
        </html>
    <?php }
}
