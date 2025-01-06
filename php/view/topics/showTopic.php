<?php
    $topic = $data["topic"] ?? null;
?>

<link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/topic.css">
<script src="<?= PUBLIC_DIR ?>/js/emojiPicker.js" defer></script>
<script src="<?= PUBLIC_DIR ?>/js/topic.js" defer></script>



<div class="container">
    
    <div class="topic-container">
        <article class="topic-content">
            <div class="category-badge">
                <?= $topic->getCategory()->getName() ?>
            </div>
            <div class="topic-header">
                <h1><?= $topic->getTitle() ?></h1>
                <div class="topic-meta">
                    <span class="author">From <span><?= $topic->getUser()->getUsername() ?></span></span>
                    <span>•</span>
                    <span class="date"><?= $topic->getTimeDiff() ?> ago</span>
                </div>
            </div>
            <hr />
            <div class="topic-body">
                <?= $topic->getContent() ?>
            </div>
        </article>

        <section class="posts-section">
            <h2>Answers</h2>
            
            <!-- Formulaire de création de post -->
            <?php include('view/partials/flash.php'); ?>
            <form action="?ctrl=topic&action=addPost" method="post" class="post-form">
                <input type="hidden" name="topicId" value="<?= $topic->getId() ?>">
                <div class="form-group">
                    <textarea name="content" placeholder="Your answer" id="inputResponse" required></textarea>
                    <img src="https://img.icons8.com/?size=80&id=V67JId5JFP2H&format=png" alt="emoji picker" class="emojipicker">
                </div>
                <button type="submit" class="submit-btn">Post</button>
            </form>
           
        </section>
    </div>
</div>
