<?php class VMain extends View
{
    private $data;

    function __construct($data)
    {
        $this->data = $data;
    }

    function view_body()
    {
        require('top_panel.php'); ?>
        <div class="idea_list">
            <!--            foreach -->
            <?php foreach ($this->data as $idea) { ?>
                <div class="idea">
                    <div class="idea_main">
                        <a href="TODO" class="idea_title"><?php echo $idea['title'] ?></a>

                        <div class="idea_tags">
                            <?php foreach (explode(',', $idea['tags']) as $tag) { ?>
                                <a href="TODO" class="idea_tag"><?php echo $tag ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="idea_stats">
                        <div class="idea_stat">
                            <div class="idea_stat_number">0</div> <!--TODO-->
                            <div class="idea_stat_desc">votes</div> <!--TODO-->
                        </div>
                        <div class="idea_stat">
                            <div class="idea_stat_number">0</div> <!--TODO-->
                            <div class="idea_stat_desc">comments</div> <!--TODO-->
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div style="height:0;width:0;clear:both;"></div>
        </div>
    <?php
    }
}
