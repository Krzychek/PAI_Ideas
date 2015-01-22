<?php class VIdeas extends View
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
                <div class="major_section">
                    <div class="idea_main">
                        <a href="<?= $GLOBALS['mainFolder'] ?>/idea/<?=$idea['idea_id']?>" class="idea_title"><?= $idea['title'] ?></a>

                        <div class="idea_tags">
                            <?php foreach (explode(',', $idea['tags']) as $tag) { ?>
                                <a href="<?= $GLOBALS['mainFolder'] ?>/tag/<?= $tag ?>" class="idea_tag"><?= $tag ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="idea_stats">
                        <div class="idea_stat">
                            <div class="idea_stat_number"><?= $idea['score'] ?></div>
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
