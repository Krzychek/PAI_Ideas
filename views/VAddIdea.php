<?php class VAddIdea extends View
{
    function view_body()
    {
        require('top_panel.php'); ?>
        <div class="content">
            <form method="post">
                <div class="major_section">
                    <div class="major_section_header">1. Podaj tytuł swojego pomysłu:</div>
                    <div class="idea_title">
                        <label>
                            <input class="title_input" type="text" name="title"/>
                        </label>
                    </div>
                </div>
                <div class="major_section">
                    <div class="major_section_header">2. Podaj tagi oddzielone przecinkami:</div>
                    <div class="idea_tags">
                        <label>
                            <input class="tags_input" type="text" name="tags"/>
                        </label>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="major_section idea_desc">
                    <div class="major_section_header">3. Dokładnie opisz swój pomysł:</div>
                    <label>
                        <textarea class="desc_input" name="content"></textarea>
                    </label>
                    <input type=submit value="Wyślij swój pomysł" class="form_button">
                </div>
            </form>

            <div class="clear"></div>
        </div>
    <?php
    }
}
