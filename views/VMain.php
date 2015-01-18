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
        <div class="content">
            <?php foreach ($this->data as $idea) { ?>
                <div class="section">
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
                            <div class="idea_stat_number"><?= $idea['score']?></div>
                            <div class="idea_stat_desc">SCORE</div>
                        </div>
                        <div class="idea_stat">
                            <div class="idea_stat_number">0</div> <!--TODO-->
                            <div class="idea_stat_desc">comments</div> <!--TODO-->
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php
    }
}
