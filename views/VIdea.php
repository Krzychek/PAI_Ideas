<?php class VIdea extends View
{
    private $idea;
    private $comments;

    function __construct($idea, $comments)
    {
        $this->idea = $idea;
        $this->comments = $comments;
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
                        <div class="idea_stat_number"><?= $this->idea['comments_count'] ?></div>
                        <div class="idea_stat_desc">comments</div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="major_section idea_desc">
                <?= $this->idea['description'] ?>
            </div>
            <hr/>
            <div class="major_section" style="text-align: center;font-weight:bolder;">KOMENTARZE</div>
            <div class="major_section">
                <?php $this->generateComments($this->comments); ?>
            </div>

            <div class="major_section" style="text-align: center;font-weight:bolder;">Dodaj swój komentarz:</div>
            <div class="major_section">
                <form method="POST" action="/makeapp/comment/add/<?= $this->idea['idea_id'] ?>">
                    <textarea class="desc_input" style="height: 100px;" name="content"></textarea>
                    <input class="form_button" type="submit" value="Dodaj">
                    </form>
            </div>
            <script type="application/javascript">
                function displayEditor(commentableID) {
                    var comment = document.getElementById('comm_' + commentableID),
                        wrapper = document.getElementById('comment_editor_wrapper');
                    if (comment.lastElementChild.className === 'clear') comment.removeChild(comment.lastElementChild);
                    if (!wrapper) {
                        var editor = document.createElement('form'),
                            textarea = document.createElement('textarea'),
                            sendBtn = document.createElement('input');
                        textarea.name = 'content';
                        textarea.className = 'desc_input';
                        editor.appendChild(textarea);
                        editor.className = 'editor';
                        editor.method = "POST";
                        sendBtn.className = 'form_button';
                        sendBtn.value = 'Dodaj';
                        sendBtn.type = 'submit';
                        editor.appendChild(sendBtn);
                        wrapper = document.createElement('div');
                        wrapper.appendChild(editor);
                        wrapper.className = 'editor_wrapper';
                        wrapper.id = 'comment_editor_wrapper';
                        comment.appendChild(wrapper);
                    } else {
                        comment.appendChild(wrapper.parentNode.removeChild(wrapper));
                    }

                    var child = wrapper.firstChild;
                    while (child) {
                        if (child.className == 'editor') {
                            child.action = "<?= $GLOBALS['mainFolder'] ?>/comment/add/" + commentableID;
                            break
                        }
                        child = child.nextSibling;
                    }

                    var clear = document.createElement('div');
                    clear.className = 'clear';
                    comment.appendChild(clear);
                }
            </script>
            <div class="clear"></div>
        </div>
    <?php
    }

    private function generateComments($comments)
    {
        foreach ($comments as $comment) { ?>
            <div class="comment">
                <div class="comment_content" id="comm_<?= $comment['comment_id'] ?>">
                    <div class="comment_author"><?= $comment['author'] ?></div>
                    <?= $this->parseBBCode($comment['content']) ?>
                    <button class="respond_btn" onclick="displayEditor(<?= $comment['comment_id'] ?>)">Odpowiedz
                    </button>
                </div>
                <?php if ($comment['subComments']) $this->generateComments($comment['subComments']); ?>
            </div>
        <?php }
    }
}
