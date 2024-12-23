<?php
    $topics = $data["topics"] ?? null;
    $categories = $data["categories"] ?? null;
?>

<link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/feed.css">

<div class="forum-container">
    <div class="inner-forum">
        <div class="create-topic">
            <button class="create-button">
                <i class="fa-solid fa-square-plus"></i>
                Create a topic
            </button>
        </div>

        
        <aside class="sidebar">
            <div class="section">
                <a class="menu-item" href="?ctrl=forum&action=index">
                    <i class="fas fa-list-ul"></i>
                    <span>My topics</span>
                </a>
                <a class="menu-item" href="?ctrl=forum&action=index&filter=responses">
                    <i class="fas fa-reply"></i>
                    <span>My responses</span>
                </a>
                <a class="menu-item" href="?ctrl=forum&action=index&filter=opened">
                    <i class="fas fa-lock-open"></i>
                    <span>Open topics</span>
                </a>
                <a class="menu-item" href="?ctrl=forum&action=index&filter=locked">
                    <i class="fas fa-lock"></i>
                    <span>Closed topics</span>
                </a>
            </div>
            <div class="section">
                <p>Search by category</p>
                <select name="categoryFilter" onchange="setCategoryFilter(this)">
                    <option value="0">
                        All
                    </option>
                    <?php foreach($categories as $category) : ?>
                        <option value=<?= $category->getId() ?> <?= $_GET["action"] === "showByCategory" && $_GET["id"] == $category->getId() ? "selected" : "" ?>>
                            <?= $category->getName() ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </aside>
        
    
        <section class="main-content">
            <?php if(!$topics) : ?>
                <p>No topic Found for this category</p>
            <?php else : ?>
                <?php foreach($topics as $topic) : ?>
                <div class="topic-card <?= $topic->getIsLocked() ? "locked" : "" ?>">
                <div class="category-badge">
                        <?= $topic->getCategory()->getName() ?>
                </div>
                <div class="header">
                        <span class="author <?= !$topic->getUser() ?  "deleted": ""?>">
                            <?= $topic->getUser() ? $topic->getUser()->getUsername() : "deleted user"?>
                        </span>
                        <span class="posted-time"><?= $topic->getTimeDiff() ?> ago</span>
                </div>
                <p class="title"><?= $topic->getTitle() ?></p>
                <div class="footer">
                        <!-- <div class="tags">
                            <span class="tag">PHP</span>
                            <span class="tag">SQL</span>
                        </div> -->
                        <div class="infos">
                            <div class="status">
                                <?php if($topic->getIsLocked()) : ?>
                                    <i class="fas fa-lock"></i>
                                    <span>Closed</span>
                                <?php else : ?>
                                    <i class="fas fa-lock-open"></i>
                                    <span>Open</span>
                                <?php endif ?>
                            </div>
                            <div class="comments">
                                <i class="fa-solid fa-comment-dots"></i>
                                <span class="count"><?= $topic->getPostCount() ?></span>
                            </div>
                        </div>
                </div>
                </div>
                <?php endforeach ?>
            <?php endif ?>
        </section>
    </div>
</div>

<script>
    function setCategoryFilter(e){
        const id = parseInt(e.value);
        console.log(id);
        if(id === 0){
            window.location.replace(`${window.location.pathname}?ctrl=forum&action=index`);
        } else {
            window.location.replace(`${window.location.pathname}?ctrl=forum&action=showByCategory&id=${id}`);
        }
    }
</script>
