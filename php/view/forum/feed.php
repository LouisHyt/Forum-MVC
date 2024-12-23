<?php

    if(isset($_GET['filter'])) {
        $filter = $_GET['filter'];
    } else {
        $filter = null;
    }

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
            <a class="menu-item <?= !$filter ? "active" : "" ?>" href="?ctrl=forum&action=index">
                <i class="fas fa-list-ul"></i>
                <span>My topics</span>
            </a>
            <a class="menu-item <?= $filter === "responses" ? "active" : "" ?>" href="?ctrl=forum&action=index&filter=responses">
                <i class="fas fa-reply"></i>
                <span>My responses</span>
            </a>
            <a class="menu-item <?= $filter === "opened" ? "active" : "" ?>" href="?ctrl=forum&action=index&filter=opened">
                <i class="fas fa-lock-open"></i>
                <span>Open topics</span>
            </a>
            <a class="menu-item <?= $filter === "locked" ? "active" : "" ?>" href="?ctrl=forum&action=index&filter=locked">
                <i class="fas fa-lock"></i>
                <span>Closed topics</span>
            </a>
        </aside>
    
        <section class="main-content">
            <div class="topic-card">
               <div class="header">
                    <span class="author">LouisHyt</span>
                    <span class="posted-time">15 min ago</span>
               </div>
               <p class="title">How can i increment this value ?</p>
               <div class="footer">
                    <div class="categories">
                        <span class="category">PHP</span>
                        <span class="category">SQL</span>
                    </div>
                    <div class="infos">
                        <div class="status">
                            <i class="fas fa-lock-open"></i>
                            <span class="count">Open</span>
                        </div>
                        <div class="comments">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span class="count">0</span>
                        </div>
                    </div>
               </div>
            </div>
            <div class="topic-card">
               <div class="header">
                    <span class="author">LouisHyt</span>
                    <span class="posted-time">15 min ago</span>
               </div>
               <p class="title">How can i increment this value ?</p>
               <div class="footer">
                    <div class="categories">
                        <span class="category">PHP</span>
                        <span class="category">SQL</span>
                    </div>
                    <div class="infos">
                        <div class="status">
                            <i class="fas fa-lock-open"></i>
                            <span class="count">Open</span>
                        </div>
                        <div class="comments">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span class="count">0</span>
                        </div>
                    </div>
               </div>
            </div>
            <div class="topic-card">
               <div class="header">
                    <span class="author">LouisHyt</span>
                    <span class="posted-time">15 min ago</span>
               </div>
               <p class="title">How can i increment this value ?</p>
               <div class="footer">
                    <div class="categories">
                        <span class="category">PHP</span>
                        <span class="category">SQL</span>
                    </div>
                    <div class="infos">
                        <div class="status">
                            <i class="fas fa-lock-open"></i>
                            <span class="count">Open</span>
                        </div>
                        <div class="comments">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span class="count">0</span>
                        </div>
                    </div>
               </div>
            </div>
            <div class="topic-card">
               <div class="header">
                    <span class="author">LouisHyt</span>
                    <span class="posted-time">15 min ago</span>
               </div>
               <p class="title">How can i increment this value ?</p>
               <div class="footer">
                    <div class="categories">
                        <span class="category">PHP</span>
                        <span class="category">SQL</span>
                    </div>
                    <div class="infos">
                        <div class="status">
                            <i class="fas fa-lock-open"></i>
                            <span class="count">Open</span>
                        </div>
                        <div class="comments">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span class="count">0</span>
                        </div>
                    </div>
               </div>
            </div>
            <div class="topic-card">
               <div class="header">
                    <span class="author">LouisHyt</span>
                    <span class="posted-time">15 min ago</span>
               </div>
               <p class="title">How can i increment this value ?</p>
               <div class="footer">
                    <div class="categories">
                        <span class="category">PHP</span>
                        <span class="category">SQL</span>
                    </div>
                    <div class="infos">
                        <div class="status">
                            <i class="fas fa-lock-open"></i>
                            <span class="count">Open</span>
                        </div>
                        <div class="comments">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span class="count">0</span>
                        </div>
                    </div>
               </div>
            </div>
            <div class="topic-card">
               <div class="header">
                    <span class="author">LouisHyt</span>
                    <span class="posted-time">15 min ago</span>
               </div>
               <p class="title">How can i increment this value ?</p>
               <div class="footer">
                    <div class="categories">
                        <span class="category">PHP</span>
                        <span class="category">SQL</span>
                    </div>
                    <div class="infos">
                        <div class="status">
                            <i class="fas fa-lock-open"></i>
                            <span class="count">Open</span>
                        </div>
                        <div class="comments">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span class="count">0</span>
                        </div>
                    </div>
               </div>
            </div>
            <div class="topic-card">
               <div class="header">
                    <span class="author">LouisHyt</span>
                    <span class="posted-time">15 min ago</span>
               </div>
               <p class="title">How can i increment this value ?</p>
               <div class="footer">
                    <div class="categories">
                        <span class="category">PHP</span>
                        <span class="category">SQL</span>
                    </div>
                    <div class="infos">
                        <div class="status">
                            <i class="fas fa-lock-open"></i>
                            <span class="count">Open</span>
                        </div>
                        <div class="comments">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span class="count">0</span>
                        </div>
                    </div>
               </div>
            </div>
            <div class="topic-card">
               <div class="header">
                    <span class="author">LouisHyt</span>
                    <span class="posted-time">15 min ago</span>
               </div>
               <p class="title">How can i increment this value ?</p>
               <div class="footer">
                    <div class="categories">
                        <span class="category">PHP</span>
                        <span class="category">SQL</span>
                    </div>
                    <div class="infos">
                        <div class="status">
                            <i class="fas fa-lock-open"></i>
                            <span class="count">Open</span>
                        </div>
                        <div class="comments">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span class="count">0</span>
                        </div>
                    </div>
               </div>
            </div>
            <div class="topic-card">
               <div class="header">
                    <span class="author">LouisHyt</span>
                    <span class="posted-time">15 min ago</span>
               </div>
               <p class="title">How can i increment this value ?</p>
               <div class="footer">
                    <div class="categories">
                        <span class="category">PHP</span>
                        <span class="category">SQL</span>
                    </div>
                    <div class="infos">
                        <div class="status">
                            <i class="fas fa-lock-open"></i>
                            <span class="count">Open</span>
                        </div>
                        <div class="comments">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span class="count">0</span>
                        </div>
                    </div>
               </div>
            </div>
            <div class="topic-card">
               <div class="header">
                    <span class="author">LouisHyt</span>
                    <span class="posted-time">15 min ago</span>
               </div>
               <p class="title">How can i increment this value ?</p>
               <div class="footer">
                    <div class="categories">
                        <span class="category">PHP</span>
                        <span class="category">SQL</span>
                    </div>
                    <div class="infos">
                        <div class="status">
                            <i class="fas fa-lock-open"></i>
                            <span class="count">Open</span>
                        </div>
                        <div class="comments">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span class="count">0</span>
                        </div>
                    </div>
               </div>
            </div>
            <div class="topic-card">
               <div class="header">
                    <span class="author">LouisHyt</span>
                    <span class="posted-time">15 min ago</span>
               </div>
               <p class="title">How can i increment this value ?</p>
               <div class="footer">
                    <div class="categories">
                        <span class="category">PHP</span>
                        <span class="category">SQL</span>
                    </div>
                    <div class="infos">
                        <div class="status">
                            <i class="fas fa-lock-open"></i>
                            <span class="count">Open</span>
                        </div>
                        <div class="comments">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span class="count">0</span>
                        </div>
                    </div>
               </div>
            </div>
        </section>
    </div>
</div>
