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
            <div class="section">
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
            </div>
            <div class="section">
                <p>Search by category</p>
                <select name="" id="">
                    <option value="web">
                        <a href="?">Web</a>
                    </option>
                    <option value="web">
                        <a href="?">Mobile</a>
                    </option>
                    <option value="web">
                        <a href="?">Design</a>
                    </option>
                </select>
            </div>
            <div class="section">
                <p>Search by tags</p>
                <form action="">
                    <div class="tag-item">
                        <label for="php">php</label>
                        <input type="checkbox" name="php" id="php">
                    </div>
                    <div class="tag-item">
                        <label for="sql">sql</label>
                        <input type="checkbox" name="sql" id="sql">
                    </div>
                    <div class="tag-item">
                        <label for="javascript">Javascript</label>
                        <input type="checkbox" name="javascript" id="javascript">
                    </div>
                    <div class="tag-item">
                        <label for="ai">AI</label>
                        <input type="checkbox" name="ai" id="ai">
                    </div>
                    
                </form>
            </div>
        </aside>
        
    
        <section class="main-content">
            <div class="topic-card">
               <div class="header">
                    <span class="author">LouisHyt</span>
                    <span class="posted-time">15 min ago</span>
               </div>
               <p class="title">How can i increment this value ?</p>
               <div class="footer">
                    <div class="tags">
                        <span class="tag">PHP</span>
                        <span class="tag">SQL</span>
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
