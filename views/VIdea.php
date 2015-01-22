<?php class VIdea extends View
{
    private $idea;
    private $comments;

    function __construct($idea, $comments)
    {
        $this->idea = $idea;
        $this->comments = $comments;
    }

    private function generateComments($comments)
    {
        foreach ($comments as $comment) { ?>
            <div class="comment">
                <div class="comment_content">
                    <div class="comment_author"><?= $comment['author'] ?></div>
                    <?= $comment['content'] ?>
                </div>
                <?php if ($comment['subComments']) $this->generateComments($comment['subComments']); ?>
            </div>
        <?php }
    }

    function view_body()
    {
        require('top_panel.php'); ?>
        <div class="content">
            <div class="major_section">
                <div class="idea_main">
                    <div class="idea_title"><?= $this->idea['title'] ?></div>

                    <div class="idea_tags">
                        <?php foreach (explode(',', $this->idea['tags']) as $tag) { ?>
                            <a href="<?= $GLOBALS['mainFolder'] ?>/tag/<?= $tag ?>" class="idea_tag"><?= $tag ?></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="idea_stats">
                    <div class="idea_stat">
                        <div class="idea_stat_number"><?= $this->idea['score'] ?></div>
                        <div class="idea_stat_desc">SCORE</div>
                    </div>
                    <div class="idea_stat">
                        <div class="idea_stat_number">0</div>
                        <!--TODO-->
                        <div class="idea_stat_desc">comments</div>
                        <!--TODO-->
                    </div>
                </div>
            </div>
            <div class="major_section idea_desc"><?= $this->idea['description'] ?></div>
            <hr/>
            <div class="major_section" style="text-align: center;font-weight:bolder;">KOMENTARZE</div>
            <div class="major_section">
                <?php $this->generateComments($this->comments); ?>
            </div>
            <script type="application/javascript">
                function displayEditor () {
                    var editor = document.createElement('form'),
                        editorWrapper = document.createElement('div'),
                        textarea = document.createElement('textarea'),
                        sendBtn = document.createElement('button'),
                        clear = document.createElement('div') ;
                    editor.appendChild(textarea);
                    editor.className = 'editor';
                    sendBtn.innerText = 'OK';
                    editor.appendChild(sendBtn);
                    editorWrapper.appendChild(editor);
                    editorWrapper.className = 'editor_wrapper';
                    document.getElementsByClassName('comment')[0].appendChild(editorWrapper);
                    clear.className = 'clear';
                    document.getElementsByClassName('comment')[0].appendChild(clear);
                }
            </script>
        </div>
    <?php
    }
}
