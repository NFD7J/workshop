<?php $title = "Gestion des catégories" ?>
<!-- Menu secondaire -->
<nav class="submenu">
    <ul>
        <li><a href="index.php?controller=admin">Ateliers</a></li>
        <li><a href="index.php?controller=admin&action=reservation">Réservations</a></li>
        <li><a href="index.php?controller=admin&action=category" class="active">Catégories</a></li>
    </ul>
</nav>

<section class="activity-list" style="position: relative;">
    <h2>Liste des catégories</h2>
    <a href="index.php?controller=admin&action=addCategory" class="btn-nav" id="button-add" style="text-decoration: none; position: absolute; right: 0; top: 0;">+ Ajouter</a>
    <ul>
        <?php foreach($categories as $category): ?>
        <a href="index.php?controller=admin&action=editCategory&id=<?= $category->category_id ?>" data-id="<?= $category->category_id ?>" style="text-decoration: none; color: inherit;" class="activity">
            <li class="activity-item">
                <span class="activity-title"><?= $category->libelle ?></span>
                <span class="activity-info"><?= $category->workshops_count ?> ateliers</span>
            </li>
        </a>
        <?php endforeach; ?>
    </ul>
</section>

<!-- Modal add -->
<div class="container-add">
    <section class="add-category">
        <h2>Ajouter une catégorie</h2>
        <form action="index.php?controller=admin&action=addCategory" method="POST">
            <div class="form-group">
                <label for="title">Nom de la catégorie :</label>
                <input type="text" id="title" name="title" required>
            </div>
            <button type="submit" class="btn-submit">Ajouter la catégorie</button>
        </form>
    </section>
</div>

<!-- Modal edit -->
<div class="container-edit">
    <div class="edit-category">
        <h2>Modifier une catégorie</h2>
        <form action="index.php?controller=admin&action=editCategory" method="POST" id="form-edit-modal">
            <div class="form-group">
                <label for="title">Nom de la catégorie :</label>
                <input type="text" id="title" name="title" required value="<?= $category->libelle ?>">
            </div>
            <input type="hidden" name="id" value="<?= $category->category_id ?>">
            <button type="submit" class="btn-submit">Modifier la catégorie</button>
        </form>
        <a href="index.php?controller=admin&action=deleteCategory" class="btn-danger" id="supprimer">Supprimer</a>
    </div>
</div>

<!-- JS -->
<script>
let link;
/*** Modal add ***/
    const containerAdd = document.querySelector('.container-add');
    const formAdd = document.querySelector('.add-category form');
    const buttonAdd = document.getElementById('button-add');
    
    buttonAdd.addEventListener('click', (e) => { 
        e.preventDefault();
        containerAdd.style.display = 'flex'; 
    });

    window.addEventListener('click', (e) => { 
        if(e.target === containerAdd) { 
            containerAdd.style.display = 'none';
            formAdd.reset(); 
        } 
    });

    formAdd.addEventListener('submit', (e) => { 
        e.preventDefault(); 
        let formdata = new FormData(formAdd);
        fetch("index.php?controller=admin&action=addCategory",{method:"POST", body: formdata})
        .then(response => response.json())
        .then(data =>{
            let a = document.createElement('a');
            a.classList.add('activity'); 
            a.setAttribute('data-id', data.category.category_id);
            a.setAttribute('href', 'index.php?controller=admin&action=editCategory&id=' + data.category.category_id); 
            a.style.textDecoration = 'none'; 
            a.style.color = 'inherit';
            a.innerHTML = `
            <li class="activity-item">
                <span class="activity-title"> ${data.category.libelle} </span>
                <span class="activity-info"> ${data.category.workshops_count} ateliers</span>
            </li>`;
            document.querySelector('.activity-list ul').appendChild(a);
            containerAdd.style.display = 'none';
            formAdd.reset();

            a.addEventListener('click', (e) =>{
                e.preventDefault();
                link = a.getAttribute('href');
                console.log(a.dataset.id);
                fetch("index.php?controller=admin&action=getCategory&id=" + a.dataset.id)
                .then(response => response.json())
                .then(data => {
                    document.querySelector('.edit-category form input[name="title"]').value = data.libelle;
                    document.querySelector('.edit-category form input[name="id"]').value = data.category_id;
                    let supprimer = document.getElementById('supprimer');
                    if(data.workshops_count <= 0) {
                        supprimer.style.display = 'block';
                        supprimer.setAttribute('href', 'index.php?controller=admin&action=deleteCategory&id=' + data.category_id);
                    } else {
                        supprimer.style.display = 'none';
                    }
                });
                Modal.style.display = 'flex';
            })
        })
    });

/*** Modal edit ***/
    const activities = document.querySelectorAll('.activity');
    const Modal = document.querySelector('.container-edit');
    const form = document.getElementById('form-edit-modal');

    activities.forEach(activity => {
        activity.addEventListener('click', (e) => {
            e.preventDefault();
            link = activity.getAttribute('href');
            fetch("index.php?controller=admin&action=getCategory&id=" + activity.dataset.id)
            .then(response => response.json())
            .then(data => {
                document.querySelector('.edit-category form input[name="title"]').value = data.libelle;
                document.querySelector('.edit-category form input[name="id"]').value = data.category_id;
                let supprimer = document.getElementById('supprimer');
                if(data.workshops_count <= 0) {
                    supprimer.style.display = 'block';
                    supprimer.setAttribute('href', 'index.php?controller=admin&action=deleteCategory&id=' + data.category_id);
                } else {
                    supprimer.style.display = 'none';
                }
            });
            Modal.style.display = 'flex';
        });
    });

    window.addEventListener('click', (e) => {
        if(e.target === Modal) {
            Modal.style.display = 'none';
            document.getElementById('supprimer').style.display = 'none';
            document.querySelector('.edit-category form input[name="title"]').value = '';
            document.querySelector('.edit-category form input[name="id"]').value = '';g
        }
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let formdata = new FormData(form);
        fetch(link, {method: 'POST', body: formdata})
        .then(response => response.json())
        .then(data => {
            document.querySelector(".activity[data-id='" + data.category_id + "'] .activity-title").textContent = data.libelle;
            Modal.style.display = 'none';
        });
    });
</script>

<!-- CSS -->
<style>

    .submenu {
        display: flex;
        justify-content: center;
        background-color: #f4f5f7;
        padding: 8px 40px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .submenu ul {
        list-style: none;
        display: flex;
        gap: 20px;
        margin: 0;
        padding: 0;
    }

    .submenu a {
        text-decoration: none;
        color: #4f46e5;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .submenu a:hover {
        color: #6366f1;
    }

    .submenu a.active {
        border-bottom: 3px solid #4f46e5;
    }

    .activity-list {
        max-width: 500px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .activity-list h2 {
        font-size: 1.8rem;
        margin-bottom: 20px;
        color: #333;
    }

    .activity-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        border-radius: 12px;
        background: #f9f9f9;
        margin-bottom: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .activity-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0,0,0,0.08);
    }

    .activity-title {
        font-weight: 600;
        color: #333;
    }

    .activity-info {
        font-size: 0.9rem;
        color: #555;
        display: flex;
        gap: 15px;
    }

/*** Modal ***/
  /* modal edit */
    .container-edit {
        display: none;
        height: 100vh;
        width: 100vw;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .edit-category {
        position: relative;
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.05);
    }

    .edit-category h2 {
        text-align: center;
        color: #4f46e5;
        margin-bottom: 25px;
    }
  /* modal add */
    .container-add{
        display: none;
        height: 100vh;
        width: 100vw;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .add-category {
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.05);
    }

    .add-category h2 {
        text-align: center;
        color: #4f46e5;
        margin-bottom: 25px;
    }


    .form-group {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        margin-bottom: 5px;
        font-weight: 500;
        color: #333;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #4f46e5;
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: opacity 0.3s ease;
    }

    .btn-submit:hover {
        opacity: 0.9;
    }

    .btn-danger {
        display: inline-block;
        position: relative;
        margin-top: 10px;
        padding: 10px 15px;
        background-color: #e53e3e;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: background-color 0.3s ease;
        text-align: center;
    }
    .btn-danger:hover {
        background-color: #c53030;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        position: relative;
        top: 120px;
        left: 20px;
        padding: 8px 14px;
        background: #f3f4f6;
        color: #2563eb;
        font-weight: 600;
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .back-btn:hover {
        background: #cdcdcd;
        color: white;
        box-shadow: 0 4px 12px rgba(163, 163, 163, 0.3);
    }


</style>
