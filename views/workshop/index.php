<?php $title = "All Workshops & Events" ?>
<aside class="sidebar">
    <h3>Filter by category</h3>

    <ul class="filters">
        <form action="index.php?controller=workshop&action=index" method="post" class="formulaire">
            <?php foreach($categories as $category): ?>
                <li>
                    <label>
                        <input type="checkbox" name="category[]" value="<?= $category->category_id ?>" <?php if(isset($_POST['category']) && in_array($category->category_id, $_POST['category'])) echo 'checked'; ?>>
                        <?= $category->libelle ?>
                    </label>
                </li>
            <?php endforeach; ?>
            <div class="div-btn">
            </div>
        </form>
    </ul>
</aside>
<section class="events-list">
    <h2>All Workshops & Events</h2>

    <ul class="list">
        <?php foreach($workshops as $workshop): ?>
        <a href="index.php?controller=workshop&action=show&id=<?= $workshop->workshops_id ?>" class="onclick">
            <li class="list-item">
                <div class="item-image">
                    <img src="../views/images/<?= $workshop->image ?>" alt="<?= $workshop->title ?>">
                </div>
                <div class="item-content">
                    <h3><?= $workshop->title ?></h3>
                    <p><?= $workshop->description ?></p>
                </div>
                <div style="display: flex; flex-direction: column; gap: 5px; align-items: center;" class="item-meta">
                    <span class="meta">📅 <?= date("d/m/Y", strtotime($workshop->date)) ?></span>
                    <span class="meta"><?= date("H\hi", strtotime($workshop->date)) ?></span>
                    <span class="meta">👥 <?= $workshop->capacity ?> seats <br>👥 <?= $workshop->capacity_left ?> left</span>
                </div>
            </li>
        </a>
        <?php endforeach; ?>
    </ul>
</section>

<!-- CSS -->
<style>
    .events-list {
        max-width: 1100px;
        margin: auto;
        padding: 0 20px;
    }

    .events-list h2 {
        margin-bottom: 30px;
        font-size: 2rem;
    }

    .list {
        list-style: none;
    }

    .onclick{
        text-decoration: none;
    }

    .list-item {
        max-height: 180px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 0 25px 0 0;
        background: white;
        border-radius: 12px;
        margin-bottom: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        transition: transform 0.2s ease;
    }

    .list-item:hover {
        transform: translateX(5px);
    }

    .list-item h3 {
        margin-bottom: 5px;
        font-size: 1.2rem;
    }

    .list-item p {
        color: #64748b;
        font-size: 0.95rem;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        line-clamp: 3;
        -webkit-line-clamp: 3;
        overflow: hidden;
    }

    .item-image{
        height: 100%;
        width: 20%;
        border-radius: 8px 0 0 8px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .item-image img {
        height: 180px;
        border-radius: 8px 0 0 8px;
        object-fit: cover;
        object-position: center;
        flex-shrink: 0;
        overflow: hidden;
    }

    .item-content {
        flex: 1;
    }

    .item-meta {
        display: flex;
        flex-direction: column;
        gap: 5px;
        align-items: center;
    }

    .meta {
        font-size: 0.9rem;
        color: #475569;
        white-space: nowrap;
    }
/*aside*/
    .sidebar {
        position: relative;
        width: 50%;
        margin: 20px auto;
        text-align: center;
        background: white;
        padding: 0 25px 25px 25px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }

    .sidebar h3 {
        font-size: 1.1rem;
        margin: 0;
        margin-bottom: 0.5em;
        padding-top: 10px;
    }

    .formulaire{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }

    .filters {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .filters li {
        display: flex;
        align-items: center;
    }

    .filters label {
        display: flex;
        align-items: center;
        gap: 2px;
        color: #475569;
        cursor: pointer;
    }

    .filters input[type="checkbox"] {
        accent-color: #4f46e5;
        cursor: pointer;
    }

    .btn {
        cursor: pointer;
        padding: 9px;
        border-radius: 10px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        border: none;
        color: white;
        text-decoration: none;
        font-weight: 600;
    }

    .onclick{
        text-decoration: none;
        color: inherit;
    }
</style>

<!-- JS -->
<script>
const formFilters = document.querySelector('.formulaire');
const container = document.querySelector('.list');
formFilters.addEventListener('input', () => {
    container.innerHTML = '';
    fetch('index.php?controller=workshop&action=index', {
        method: 'POST',
        body: new FormData(formFilters)
    })
    .then(response => response.json())
    .then(data => {
        data.forEach(workshop => {
            let card = document.createElement('a');
            card.href = "index.php?controller=workshop&action=show&id=" + workshop.workshops_id;
            card.classList.add('onclick');
            card.innerHTML = `
            <li class="list-item">
                <div class="item-image">
                    <img src="../views/images/${workshop.image}" alt="${workshop.title}">
                </div>
                <div class="item-content">
                    <h3>${workshop.title}</h3>
                    <p>${workshop.description}</p>
                </div>
                <div style="display: flex; flex-direction: column; gap: 5px; align-items: center;" class="item-meta">
                    <span class="meta">📅 ${new Date(workshop.date).toLocaleDateString()}</span>
                    <span class="meta">${new Date(workshop.date).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                    <span class="meta">👥 ${workshop.capacity} seats <br>👥 ${workshop.capacity_left} left</span>
                </div>
            </li>`;
            container.appendChild(card);
        });
    })
});
</script>