<?php
    $topic = $data["topics"] ?? null;
    $posts = $data["posts"] ?? null;
?>

<link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/topic.css">



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
            <div class="topic-body">
                <?= $topic->getContent() ?>
            </div>
        </article>

        <section class="posts-section">
            <h2>Answers</h2>
            
            <!-- Formulaire de création de post -->
            <?php include('view/partials/flash.php'); ?>
            <?php if($topic->getIsLocked()): ?>
                <div class="locked-info">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>This topic is locked! You can't post any answer.</span>
                </div>
            <?php else: ?>
                <form action="?ctrl=topic&action=addPost" method="post" class="post-form">
                    <input type="hidden" name="topicId" value="<?= $topic->getId() ?>">
                    <div class="form-group">
                        <textarea name="content" placeholder="Your answer" id="inputResponse" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Post</button>
                </form>
            <?php endif; ?>
            
            <?php if($posts) :?>
                <?php foreach($posts as $post) : ?>
                    <article class="post">
                        <div class="post-header">
                            <span class="author"><?= $post->getUsername() ?></span>
                            <span class="date"><?= $post->getTimeDiff() ?> ago</span>
                        </div>
                        <div class="post-body">
                            <?= $post->getContent() ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <article class="post">
                    <div class="post-body">
                        <p>This Topic has no answers yet</p>
                    </div>
                </article>
            <?php endif; ?>
        </section>
    </div>
</div>
