<?php class VMain extends View
{
    function view_body()
    {
        require('top_panel.php'); ?>
        <div class="idea_list">
<!--            foreach -->
            <div class="idea">
                <div style="height:0;width:0;clear:both"></div>
                <div class="idea_main">
                    <a href="TODO" class="idea_title">First not real, but cute idea</a>
                    <div class="idea_tags">
                        <a href="TODO" class="idea_tag">First</a>
                        <a href="TODO" class="idea_tag">cute</a>
                    </div>
                </div>
                <div class="idea_stats">
                    <div class="idea_stat">
                        <div class="idea_stat_number">0</div>
                        <div class="idea_stat_desc">votes</div>
                    </div>
                    <div class="idea_stat">
                        <div class="idea_stat_number">0</div>
                        <div class="idea_stat_desc">comments</div>
                    </div>
                </div>
            </div>
            <div class="idea">
                <div class="idea_main">
                    <a href="TODO" class="idea_title">Second not real, but awesome idea</a>
                    <div class="idea_tags">
                        <a href="TODO" class="idea_tag">second</a>
                        <a href="TODO" class="idea_tag">awesome</a>
                    </div>
                </div>
                <div class="idea_stats">
                    <div class="idea_stat">
                        <div class="idea_stat_number">1</div>
                        <div class="idea_stat_desc">votes</div>
                    </div>
                    <div class="idea_stat">
                        <div class="idea_stat_number">1</div>
                        <div class="idea_stat_desc">comments</div>
                    </div>
                </div>
            </div>
            <div style="height:0;width:0;clear:both"></div>
        </div>
    <?php
    }
}
