<?php class VMain extends View
{
    function view_body()
    {
        require('top_panel.php'); ?>
        <div class="idea_list">
<!--            foreach -->
            <div class="idea">
                <div class="idea_section">
                    <div class="idea_title"></div>
                    <div class="idea_tags"></div>
                </div>
                <div class="idea_section">
                    <div class="idea_stat">
                        <div class="idea_stat_number"></div>
                        <div class="idea_stat_description"></div>
                    </div>
                    <div class="idea_stat">
                        <div class="idea_stat_number"></div>
                        <div class="idea_stat_description"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}
