<?php

    $topics = $data["topics"] ?? null;
    $categories = $data["categories"] ?? null;
    $filterType = $_GET["type"] ?? null;
?>

<link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/feed.css">
<script src="<?= PUBLIC_DIR ?>/js/feed.js" defer></script>


<div class="forum-container">

    <?php include('view/partials/flash.php'); ?>

    <div class="inner-forum">

        <!-- Confirmation Dialog -->
        <dialog id="confirmLock">
            <div class="title">
                <p>Are you sure you want to lock this topic ?</p>
                <p>(this cannot be undone)</p>
            </div>
            <div class="actions">
                <button class="confirm button">Confirm</button>
                <button class="deny button">Deny</button>
                <input id="confirmTopicId" type="hidden" name="topicId" value="">
            </div>
        </dialog>

        <div class="create-topic">
            <a class="create-button" href="?ctrl=topic&action=create">
                <i class="fa-solid fa-square-plus"></i>
                Create a topic
            </a>
        </div>

        
        <aside class="sidebar">
            <div class="section">
                <a class="menu-item <?= !$filterType ? "active": "" ?>" href="?ctrl=forum&action=index">
                    <i class="fas fa-list-ul"></i>
                    <span>Feed</span>
                </a>
                <a class="menu-item <?= $filterType === "owner" ? "active": "" ?>" href="?ctrl=forum&action=showByType&type=owner">
                    <i class="fa-solid fa-book"></i>
                    <span>My topics</span>
                </a>
                <a class="menu-item  <?= $filterType === "responses" ? "active": "" ?>" href="?ctrl=forum&action=showByType&type=responses">
                    <i class="fas fa-reply"></i>
                    <span>My responses</span>
                </a>
                <a class="menu-item  <?= $filterType === "open" ? "active": "" ?>" href="?ctrl=forum&action=showByType&type=open">
                    <i class="fas fa-lock-open"></i>
                    <span>Open topics</span>
                </a>
                <a class="menu-item  <?= $filterType === "closed" ? "active": "" ?>" href="?ctrl=forum&action=showByType&type=closed">
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
                <div 
                    class="topic-card <?= $topic->getIsLocked() ? "locked" : "" ?>"
                    data-id=<?= $topic->getId() ?>
                >
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
                        <div class="infos">
                            <div class="status">
                                <?php if($topic->getIsLocked()) : ?>
                                    <i class="fas fa-lock"></i>
                                    <span>Closed</span>
                                <?php else : ?>
                                    <?php 
                                        if($topic->getUser() && $topic->getUser()->getId() === App\Session::getUser()->getId() && !$topic->getIsLocked()) : 
                                    ?>
                                        <i class="fas fa-lock-open lock-topic" onclick="openLockConfirmation(this)"></i>
                                        <span>Open</span>
                                    <?php else : ?>
                                        <i class="fas fa-lock-open"></i>
                                        <span>Open</span>
                                    <?php endif ?>
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